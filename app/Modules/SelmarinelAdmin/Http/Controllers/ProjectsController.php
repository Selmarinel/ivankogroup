<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelAdmin\Http\Controllers;

use App\Modules\SelmarinelCore\Database\Models\PhotoFile;
use App\Modules\SelmarinelCore\Http\Services\Image;
use Illuminate\Http\Request;
use App\Modules\SelmarinelAdmin\Http\Controllers\AdminController as Controller;

class ProjectsController extends Controller
{
    protected $prefix = 'admin:projects';
    protected $moduleName = 'selmarinel_admin';
    protected $serviceName = 'App\Modules\SelmarinelCore\Http\Services\Projects';
    protected $ware = 'auth';

    protected function index(){
        return view($this->getViewRoute(),['collection'=>$this->service->getAll()]);
    }

    public function add(Request $request){
        $this->setRules([
            'title'          =>  'required|min:2',
            'description'    =>  'required|min:3',
            'cover_id'       =>  ''
        ]);
        if($request->method() != 'GET' && isset($request['cover'])) {
            $imageId = $this->saveFile($request);
            $request->merge(array('cover_id' => $imageId));
        }
        $result = parent::add($request);
        if (isset($this->service->getModel()->id)) {
            $this->createGallery($request, $this->service->getModel()->id);
        }
        return $result;
    }

    public function edit(Request $request, $id){
        $this->setRules([
            'id'             =>  'required',
            'title'          =>  'required|min:2',
            'description'    =>  'required|min:3',
            'cover_id'       =>  ''
        ]);
        if($request->hasFile('cover')) {
            $imageId = $this->saveFile($request);
            $request->merge(array('cover_id' => $imageId));
        }
        $this->createGallery($request,$id);
        return parent::edit($request, $id);
    }

    private function saveFile(Request $request){
        $service = new Image($request->file('cover'));
        $service->saveFile(time());
        return $service->getModel()->id;
    }

    private function createGallery(Request $request,$id){
        if (isset($request['photo_ids'][0])){
            foreach($request['photo_ids'] as $key=>$file_id){
                $model = new PhotoFile();
                $photo = PhotoFile::query()->where('id',$file_id)->first();
                if (!$photo) {
                    $model->fill([
                        'cover_id' => $file_id,
                        'project_id' => $id,
                        'name'  =>  $request->input('title')
                    ]);
                    $model->save();
                }
            }
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelAdmin\Http\Controllers;

use App\Modules\SelmarinelAdmin\Http\Controllers\AdminController as Controller;
use App\Modules\SelmarinelCore\Http\Services\Image;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    protected $prefix = 'admin:files';
    protected $moduleName = 'selmarinel_admin';
    protected $serviceName = 'App\Modules\SelmarinelAdmin\Http\Services\Files';
    protected $ware = 'auth';

    protected function index(){
        return view($this->getViewRoute(),['collection'=>$this->service->getAll()]);
    }

    public function edit(Request $request,$id)
    {
        $this->setRules([
            'id'    =>  'required',
            'name'  =>  'required|min:2',
            'cover_id'       =>  ''
        ]);
        if($request->hasFile('cover')) {
            $imageId = $this->saveFile($request);
            $request->merge(array('cover_id' => $imageId));
        }
        return parent::edit($request, $id);
    }
    private function saveFile(Request $request){
        $service = new Image($request->file('cover'));
        $service->saveFile(time());
        return $service->getModel()->id;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelGallery\Http\Controllers;

use App\Modules\SelmarinelCore\Http\Services\Image;
use Illuminate\Http\Request;
use App\Modules\SelmarinelCore\Http\Controllers\Controller;

class GalleryController extends Controller
{
    protected $serviceName = 'App\Modules\SelmarinelCore\Http\Services\Projects';

    public function addPhoto(Request $request){
        if (!$request->hasFile('file_photo')) {
            return $this->sendWithErrors('Image is not found', 404);
        }
        $image = $this->saveFile($request);
        return $this->sendOk([
            'image' => $image->getCover(),
            'id'=> $image->id
        ]);
    }

    private function saveFile(Request $request){
        $service = new Image($request->file('file_photo'));
        $service->saveFile(time());
        return $service->getModel();
    }

    public function delPhoto(Request $request,$id){
        if(!$id){
            return $this->sendWithErrors('Id is incorect', 404);
        }
        $service = new Image();
        $model = $service->getOne($id);
        if (!$model->id){
            return $this->sendWithErrors('Not found file',404);
        }
        $model->delete();
        return $this->sendOk();
    }
}
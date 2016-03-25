<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelAdmin\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\SelmarinelAdmin\Http\Controllers\AdminController as Controller;

class CommentsController extends Controller
{
    protected $prefix = 'admin:comments';
    protected $moduleName = 'selmarinel_admin';
    protected $serviceName = 'App\Modules\SelmarinelAdmin\Http\Services\Comments';
    protected $ware = 'auth';

    protected function index(){
        return view($this->getViewRoute(),['collection'=>$this->service->getAll()]);
    }

    public function edit(Request $request,$id)
    {
        $this->setRules([
            'id'    =>  'required',
            'text'  =>  'required|min:2',
        ]);
        return parent::edit($request, $id);
    }
}
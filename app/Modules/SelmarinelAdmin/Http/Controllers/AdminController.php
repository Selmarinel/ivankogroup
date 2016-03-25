<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelAdmin\Http\Controllers;

use App\Modules\SelmarinelAdmin\Database\Models\Order;
use App\Modules\SelmarinelAdmin\Http\Services\Comments;
use App\Modules\SelmarinelAdmin\Http\Services\Orders;
use Illuminate\Http\Request;
use App\Modules\SelmarinelCore\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $prefix = 'admin:main';
    protected $moduleName = 'selmarinel_admin';
    protected $ware = 'auth';

    protected function index(){
        $service = new Orders();
        $service->setWhere(['status'=>[Order::STATUS_ACTIVE,Order::STATUS_NOT_CHK]]);
        $collection = $service->getAll();
        $comments = new Comments();
        $comments->setWhere(['status'=>[Order::STATUS_ACTIVE]]);
        foreach($comments->getAll() as $comment){
            $collection->add($comment);
        }
        return view($this->getViewRoute(),
            ['collection'=>$collection
                ->sortByDesc(function ($item) {
                    return $item->created_at;
                })]
        );
    }

    /**
     * @param Request $request
     * @return \App\Modules\VergoBase\Http\Requests\Response|\Illuminate\Http\Response
     */
    protected function add(Request $request){
        if ($request->method() == 'GET') {
            return view($this->getViewRoute('edit'), $this->prepareData());
        }
        return $this->postEdit($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \App\Modules\VergoBase\Http\Requests\Response|\Illuminate\Http\Response
     */
    protected function edit(Request $request, $id){
        if (!isset($id)){
            return redirect($this->getRoute());
        }
        $this->service->getOne($id);
        if($this->service->isErrors()) {
            abort(404);
        }
        if ($request->method() == 'GET') {
            return view($this->getViewRoute('edit'), $this->prepareData($this->service->getModel()));
        }
        return $this->postEdit($request,$id);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function active($id){
        return $this->changeStatus($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function delete($id){
        $model = $this->service->getModel();
        return $this->changeStatus($id, $model::STATUS_DELETED);
    }

    private function changeStatus($id, $status = null){
        if(!$id) {
            abort(404, 'Article is Not Found');
        }

        $this->service->getOne($id);
        $this->service->setStatus($status);
        return redirect($this->getRoute());
    }

    protected function postEdit(Request $request){
        if ($this->isValidationFails($request)){
            return $this->sendWithErrors($this->getValidatorErrors());
        }
        $this->service->getModel()->fill($this->getRulesInput($request));
        if($this->service->getModel()->save()){
            return $this->sendOk(['goto'=>$this->getRoute()]);
        }
        return $this->sendWithErrors('Something went wrong');
    }

    protected function prepareData($model = null){
        return ['model' => (isset($model->id)) ? $model : $this->service->getModel()];
    }

}
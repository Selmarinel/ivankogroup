<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelAdmin\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Modules\SelmarinelAdmin\Database\Models\Order;
use App\Modules\SelmarinelAdmin\Http\Controllers\AdminController as Controller;
use App\Modules\SelmarinelCore\Database\Models\Base;

class OrdersController extends Controller
{
    protected $prefix = 'admin:orders';
    protected $moduleName = 'selmarinel_admin';
    protected $serviceName = 'App\Modules\SelmarinelAdmin\Http\Services\Orders';
    protected $ware = 'auth';

    protected function index(){
        return view($this->getViewRoute(),['collection'=>$this->service->getAll()]);
    }

    public function decline($id){
        $model = $this->service->getOne($id);
        if(!$model){
            return redirect($this->getRoute());
        }
        if ($model->mail) {
            if (filter_var($model->mail, FILTER_VALIDATE_EMAIL)){
                Mail::send('selmarinel_admin::emails.decline', ['model'=>$model], function ($message) use ($model) {
                    $message->from('ivngrup@gmail.com', 'IvankoGroup');
                    $message->to($model->mail, 'IvankoGroup')->subject('Заказ отменен');
                });
            }
        }
		$model->status = Order::Decline;
        $model->save();
        return redirect($this->getRoute());
    }

    public function active($id){
        $model = $this->service->getOne($id);
        if (!$model){
            return redirect($this->getRoute());
        }
        if ($model->status == Base::STATUS_NOT_CHK){
            $model->status = Base::STATUS_ACTIVE;
        }
        elseif($model->status == Base::STATUS_ACTIVE){
            $model->status = Order::EMailFail;
            if ($model->mail) {
                if (filter_var($model->mail, FILTER_VALIDATE_EMAIL)){
                    Mail::send('selmarinel_admin::emails.complete', ['model'=>$model], function ($message) use ($model) {
                        $message->from('ivngrup@gmail.com', 'IvankoGroup');
                        $message->to($model->mail, 'IvankoGroup')->subject('Ваш заказ выполнен');
                    });
                    $model->status = Order::STATUS_INCLUDED_OFF;
                }
            }
        }
        $model->save();
        return redirect($this->getRoute());
    }
}
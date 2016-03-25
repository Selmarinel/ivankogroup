<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelCore\Http\Controllers;

use App\Modules\SelmarinelAdmin\Http\Services\Comments;
use App\Modules\SelmarinelAdmin\Http\Services\Orders;
use App\Modules\SelmarinelCore\Http\Services\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class APIController extends SiteController
{

	public function adminSend(Request $request)
	{
		$this->setRules([
            'name' => 'required|min:2',
            'phone' => 'required|min:2',
            'email' => 'required|email',
            'text'  =>  'required'
        ]);
        if ($this->isValidationFails($request)) {
            return $this->sendWithErrors($this->getValidatorErrors());
        }
		Mail::send('selmarinel_admin::emails.info', $request->all(), function ($message) use ($request) {
            $message->from($request->all()['email'], 'IvankoGroup');
            $message->to('selmarinel@gmail.com', 'Info')->subject('Info');
        });
		return $this->sendOk();
	}

    public function sendOrder(Request $request)
    {
        $this->setRules([
            'name' => 'required|min:2',
            'phone' => 'required|min:7',
            'mail' => 'email',
            'text' => 'required|min:5'
        ]);
        if ($this->isValidationFails($request)) {
            return $this->sendWithErrors($this->getValidatorErrors());
        }
        $service = new Orders();
        Mail::send('selmarinel_admin::emails.order', $request->all(), function ($message) {
            $message->from('ivngrup@gmail.com', 'IvankoGroup');
            $message->to('ivan.slipcov@gmail.com', 'ЗАКАЗ')->subject('Заказ');
            $message->to('ivan.slipcov@ivankogroup.com', 'ЗАКАЗ')->subject('Заказ');
        });
        $service->getModel()->fill($request->all());
        $service->getModel()->save();
        return $this->sendOk(['order' => 'clear']);
    }

    public function addComment(Request $request, $id)
    {
        $this->setRules([
            'user' => 'required|min:2',
            'text' => 'required|min:2',
            'avatar' => 'required'
        ]);
        $request->merge(['project_id' => $id]);
        if ($this->isValidationFails($request)) {
            return $this->sendWithErrors($this->getValidatorErrors());
        }
        $service = new Comments();
        $service->getModel()->fill($request->all());
        $service->getModel()->save();
        return $this->sendOk(['comment' => 'true', 'id' => $id, 'model' => $service->getModel(), 'message' => 'Комментарий успешно добавлен.']);
    }

    public function increment($id)
    {
        $service = new Projects();
        $service->getOne($id);
        $service->getModel()->views = $service->getModel()->views + 1;
        $service->getModel()->save();
        return $this->sendOk();
    }
}
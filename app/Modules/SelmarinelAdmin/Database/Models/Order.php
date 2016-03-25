<?php

namespace App\Modules\SelmarinelAdmin\Database\Models;


use App\Modules\SelmarinelCore\Database\Models\Base;

class Order extends Base
{
    public $type = 'order';

    protected $perPage = 15;

    const EMailFail = 4;
    const Decline = 5;

    protected $stateName = [
        0 => 'Пришёл заказ',
        1 => 'В процессе',
        2 => 'Выполнено',
        3 => 'Удаленно',
        4 => 'Выполнено. Не правильная почта.',
        5 => 'Отменено'
    ];

    protected $stateClass = [
        0   =>  'btn-warning',
        1   =>  'btn-info',
        2   =>  'btn-success',
        3   =>  'btn-danger',
        4   =>  'btn-success',
        5   =>  'btn-danger'
    ];

    public function getStateName(){
        return $this->stateName[$this->status];
    }

    public function getStateClass(){
        return $this->stateClass[$this->status];
    }

    public function count(){
        return $this->query()->get()->count();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = array('id', 'name', 'phone', 'mail', 'text','status');

    public function fill(array $attributes) {
        parent::fill($attributes);
    }

}
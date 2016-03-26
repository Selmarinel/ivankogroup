<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 07.02.2016
 * Time: 1:29
 */

namespace App\Modules\SelmarinelCore\Database\Models;

use App;

class Comments extends Base
{
    public $type = 'comment';
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    public $timestamps = true;

    protected $fillable = array('id', 'project_id', 'user', 'text','status','avatar');

    public function fill(array $attributes) {
        parent::fill($attributes);
    }

    public function project(){
        return $this->hasOne('App\Modules\SelmarinelCore\Database\Models\Project','id','project_id');
    }

    public function getCover(){
        return ($this->avatar) ? $this->avatar : App::make('SelmarinelCore.assets')->getPath('images/user_blank.png');
    }

    public function setAvatarAttribute($value){
        $this->attributes['avatar'] = ($value) ? $value : App::make('SelmarinelCore.assets')->getPath('images/user_blank.png');
    }

    public function getInfo(){
        return [
            'id'        =>  $this->id,
            'avatar'    =>  $this->getCover(),
            'user'      =>  $this->user,
            'text'      =>  $this->text,
            'project_id'=>  $this->project_id
        ];
    }
}
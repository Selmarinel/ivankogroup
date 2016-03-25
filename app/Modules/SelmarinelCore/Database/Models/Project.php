<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 07.02.2016
 * Time: 1:29
 */

namespace App\Modules\SelmarinelCore\Database\Models;

use App;

class Project extends Base
{
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
    protected $table = 'projects';

    public $timestamps = true;

    protected $fillable = array('id', 'title', 'info', 'description', 'cover_id','views');

    public function fill(array $attributes) {
        parent::fill($attributes);
    }

    public function cover(){
        return $this->hasOne('App\Modules\SelmarinelCore\Database\Models\Cover','id','cover_id');
    }

    public function count(){
        return $this->query()->get()->count();
    }

    public function getCover($w = null, $h = null){
        return ($this->cover) ? $this->cover->getCover($w, $h) : App::make('SelmarinelCore.assets')->getPath('images/logo-alt.png');
    }

    public function getComments(){
        return (isset($this->comments)) ? $this->comments : $this->comments();
    }
    public function comments(){
        return $this->hasMany('App\Modules\SelmarinelCore\Database\Models\Comments','project_id','id')->where('status',self::STATUS_ACTIVE)->orderBy('created_at','desc');
    }

    public function getFiles(){
        return (isset($this->files)) ? $this->files : $this->files();
    }
    public function files(){
        return $this->hasMany('App\Modules\SelmarinelCore\Database\Models\PhotoFile','project_id','id')->where('status',self::STATUS_ACTIVE);
    }

    public function getShort(){
        return mb_substr(strip_tags($this->description), 0, 60, 'UTF-8') . '...';
    }

    public function setCoverIdAttribute($value){
        if($value){
            $this->attributes['cover_id'] = $value;
        }
    }

}
<?php
namespace App\Modules\SelmarinelCore\Database\Models;

use App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoFile extends Base {
    protected $path = 'photo/';

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
    protected $table = 'files';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name','project_id','cover_id','status');

    public function cover(){
        return $this->hasOne('App\Modules\SelmarinelCore\Database\Models\Cover','id','cover_id');
    }

    public function getCover(){
        return ($this->cover) ? $this->cover->getCover() : App::make('SelmarinelCore.assets')->getPath('images/logo-alt.png');
    }

    public function project(){
        return $this->hasOne('App\Modules\SelmarinelCore\Database\Models\Project','id','project_id');
    }

    public function setCoverIdAttribute($value){
        if($value){
            $this->attributes['cover_id'] = $value;
        }
    }
}
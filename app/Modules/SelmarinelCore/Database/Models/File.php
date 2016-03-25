<?php
namespace App\Modules\SelmarinelCore\Database\Models;

use App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class File extends Base {
    protected $path = 'tmp/';
    protected $type = self::TYPE_IMAGE;

    const TYPE_IMAGE = 0;

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
    protected $table = 'files_covers';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('url');

    public function cropAll($sizes = array())
    {
        if(empty($this->cropSizes)) {
            return;
        }
        // configure with favored image driver (gd by default)
        // Image::configure(array('driver' => 'imagick'));
        foreach($sizes as $w => $h)  {
            $this->crop($w, $h);
        }
    }

    public function crop($w, $h = null)
    {
        $cropPath = $this->getFullPath($this->_getCropPath($w, $h));
        $image = Image::make($this->getBasePath() . $this->getFullPath() . $this->url)->widen($w);
        Storage::makeDirectory($cropPath);
        Storage::makeDirectory(dirname($cropPath . $this->url));
        $image->save($this->getBasePath() . $cropPath . $this->url);

        return $cropPath . $this->url;
    }

    private function _getCropPath($w, $h)
    {
        return 'crop/' . $w . 'X' . $h . '/';
    }

    public function getFullPath($path = '')
    {
        $path = ($path) ? $path . DIRECTORY_SEPARATOR : $path;
        return $this->path . $path;
    }

    public function getCover($w = null, $h = null)
    {
        if(!(isset($w) || isset($h))) {
            return $this->getUrl($this->url);
        }

        if(file_exists($this->getBasePath() . $this->getFullPath($this->_getCropPath($w, $h)) . $this->url)) {
            return $this->getUrl($this->_getCropPath($w, $h) . $this->url);
        }

        return $this->getUrl($this->crop($w, $h));

    }

    private function getBasePath(){
        return storage_path() . '/app/';
    }

    private function getUrl($url){
        return config('app.files_url') . str_replace('/storage', '/', Storage::disk('local')->url($this->path . $url));
    }
}

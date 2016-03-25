<?php
namespace App\Modules\SelmarinelCore\Http\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Files extends Base{

    private $_file;

    protected $modelName = 'App\Modules\SelmarinelCore\Database\Models\File';
    protected $hasStatus = false;

    protected $cropSizes = [
        ["w" => 300, "h" => null],
        ["w" => 900, "h" => null],
    ];

    public function __construct($file = ''){
        if(isset($file)) {
            $this->_file = $file;
        }
        return parent::__construct($this->modelName);
    }

    public function saveFile($name = '') {
        $name = ($name) ? $name : bcrypt(time());
        $fileName = $this->getTimePath() . md5(bcrypt($name)) . '.' . $this->_file->getClientOriginalExtension();

        Storage::put($this->getModel()->getFullPath(). $fileName, File::get($this->_file));
        $this->getModel()->fill(['url' => $fileName]);
        $this->getModel()->save();
        $this->cropAll($this->cropSizes);

        return $this->getModel();
    }

    protected function cropAll() {
        if(empty($this->cropSizes)) {
            return;
        }
        // configure with favored image driver (gd by default)
        // Image::configure(array('driver' => 'imagick'));
        foreach($this->cropSizes as $crop)  {
            $this->getModel()->crop($crop['w'], $crop['h']);
        }
    }

    protected function getTimePath(){
        return md5(date('Y.m')) . '/';
    }
}
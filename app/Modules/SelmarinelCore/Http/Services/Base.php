<?php
namespace App\Modules\SelmarinelCore\Http\Services;

use App;
use \Illuminate\Database\Eloquent\Builder;

class Base{
    private $where = [];
    private $model;
    private $errors = [];
    protected $with = [];

    protected $orderBy = [
        'created_at' => 'desc'
    ];
    protected $modelName;
    protected $hasStatus = true;

    const MAX_LIMIT = 5000;

    /**
     * Base constructor.
     * @param $modelName
     */
    public function __construct($modelName = '\App\Modules\SelmarinelCore\Database\Models\Base') {
        $this->modelName = (isset($this->modelName)) ? $this->modelName : $modelName;
        $this->model = \App::make($this->modelName);
    }

    /**
     * @return array
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param array $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }

    /**
     * @return \App\Modules\VergoBase\Database\Models\Base
     */
    public function getModel()
    {
        return $this->model;
    }

    protected function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }
    /**
     * @param string $error
     */
    public function addError($error = '') {
        if($error) {
            $this->errors[] = $error;
        }
    }

    public function isErrors() {
        return count($this->errors);
    }

    protected function prepareWhere(Builder $query){
        foreach($this->where as $key => $value) {
            if(!is_array($value)) {
                $query->where($key, '=', $value);
            } else {
                $query->whereIn($key, $value);
            }
        }
        return $query;
    }

    private function prepareOrderBy(Builder $query){
        foreach($this->orderBy as $field => $value){
            $query->orderBy($field, $value);
        }
        return $query;
    }

    private function prepareQuery($isDeleted){
        $query = $this->getModel()->newQuery();
        $this->prepareWhere($query);
        $this->prepareOrderBy($query);
        if(!$this->hasStatus) {
            return $query;
        }
        return ($isDeleted) ? $query->deleted() : $query->notDeleted();
    }

    public function getAll($limit = self::MAX_LIMIT, $isDeleted = false){
        $query = $this->prepareQuery($isDeleted);
        $query->with($this->with);
        return $query->paginate($limit);
    }

    public function getOne($id = null, $isDeleted = false){
        $query = $this->prepareQuery($isDeleted);
        $query->with($this->with);
        $this->model = ($id) ? $query->find($id) : $query->first();
        return $this->model;
    }

    public function setStatus($status = null){
        if(!isset($this->model->status)) {
            return $this->addError('Status is not exist');
        }

        $model = $this->model;
        $this->model->status = ($model->status) ? $model::STATUS_NOT_CHK : $model::STATUS_ACTIVE;

        if(isset($status)) {
            $this->model->status = $status;
        }

        return $this->model->save();
    }
}
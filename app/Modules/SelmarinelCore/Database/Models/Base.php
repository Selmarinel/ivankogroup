<?php
namespace App\Modules\SelmarinelCore\Database\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property $status
 */
class Base extends Model {
    const STATUS_NOT_CHK      = 0;
    const STATUS_ACTIVE       = 1;
    const STATUS_INCLUDED_OFF = 2;
    const STATUS_DELETED      = 3;

    protected $stateClass = [
        0 => 'btn-info',
        1 => 'btn-success',
        2 => 'btn-info',
        3 => 'btn-danger'
    ];

    protected $stateName = [
        0 => 'Не провереная',
        1 => 'Активная',
        2 => 'Связка',
        3 => 'Удаленная',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    public function getStateClass() {
        return 'btn btn-xs ' . $this->stateClass[$this->status];
    }

    public function getStateName() {
        return $this->stateName[$this->status];
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeleted($query) {
        return $query->where('status', 3);
    }

    public function scopeNotDisable($query) {
        return $query->where('status', '!=', self::STATUS_DELETED);
    }
    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDeleted($query) {
        return $query
            ->where('status', '!=', self::STATUS_DELETED);
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetAll($query)
    {
        return $query->take(5000);
    }
    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBy($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

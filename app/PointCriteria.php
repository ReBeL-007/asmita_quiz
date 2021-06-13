<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointCriteria extends Model
{
    public $table = 'point_criterias';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function gradingCategories()
    {
        return $this->hasMany(GradingCategory::class, 'point_criteria_id')->withTrashed();
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'point_criteria_id')->withTrashed();
    }

}

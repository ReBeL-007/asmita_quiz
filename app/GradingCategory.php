<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradingCategory extends Model
{
    use SoftDeletes;

    public $table = 'grading_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'position',
        'criteria',
        'point_criteria_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pointCriteria()
    {
        return $this->belongsTo(PointCriteria::class, 'point_criteria_id')->withTrashed();
    }

}

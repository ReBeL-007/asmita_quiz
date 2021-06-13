<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Assignment extends Model implements HasMedia
{
    use SoftDeletes,HasMediaTrait;


    public $table = 'assignments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'lesson_id',
        'title',
        'instruction',
        'published',
        'due_date',
        'close_date',
        'points',
        'criteria_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'resource',
    ];

    public function getResourceAttribute()
    {
        $files = $this->getMedia('resource');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
        });

        return $files;
    }


    public function pointCriteria()
    {
        return $this->belongsTo(PointCriteria::class, 'criteria_id')->withTrashed();
    }

}

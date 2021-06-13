<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use SoftDeletes;

    public $table = 'grades';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function categoryQuestions()
    // {
    //     return $this->hasMany(Question::class, 'category_id', 'id');
    // }

    public function courses()
    {
        return $this->hasMany(Course::class, 'grade_id', 'id');
    }

    /**
         * Override parent boot and Call deleting event
         *
         * @return void
         */
        protected static function boot()
        {
            parent::boot();

            static::deleting(function($grade) {
                foreach ($grade->courses()->get() as $course) {
                $course->delete();
                }
            });
        }
}

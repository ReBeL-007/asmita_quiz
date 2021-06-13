<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';

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
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    /**
         * Override parent boot and Call deleting event
         *
         * @return void
         */
        protected static function boot() 
        {
            parent::boot();

            static::deleting(function($categories) {
                foreach ($categories->courses()->get() as $course) {
                $course->delete();
                }
            });
        }
}

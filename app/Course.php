<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Course
 *
 * @package App
 * @property string $title
 * @property string $slug
 * @property text $description
 * @property decimal $price
 * @property string $course_image
 * @property string $start_date
 * @property tinyInteger $published
*/
class Course extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['category_id','title','grade_id','slug', 'description', 'course_image','status','featured','video_type','video_url','price','discount','start_date'];

    protected $appends = [
        'thumbnail',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Set attribute to money format
     * @param $input
     */

    /**
     * Set attribute to date format
     * @param $input
     */
    // public function setStartDateAttribute($input)
    // {
    //     if ($input != null && $input != '') {
    //         $this->attributes['start_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    //     } else {
    //         $this->attributes['start_date'] = null;
    //     }
    // }

    // /**
    //  * Get attribute from date format
    //  * @param $input
    //  *
    //  * @return string
    //  */
    // public function getStartDateAttribute($input)
    // {
    //     $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     if ($input != $zeroDate && $input != null) {
    //         return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
    //     } else {
    //         return '';
    //     }
    // }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student')->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Admin::class, 'course_user');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getThumbnailAttribute()
    {
        $files = $this->getMedia('thumbnail');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function scopeOfTeacher($query)
    {

        if (!Auth::user()->isAdmin()) {
            return $query->whereHas('teachers', function($q) {
                $q->where('admin_id', Auth::user()->id);
            });
        }
        return $query;
    }
}

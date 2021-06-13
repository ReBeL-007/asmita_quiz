<?php
namespace App;

use App\Attempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Quiz
 *
 * @package App
 * @property string $course
 * @property string $lesson
 * @property string $title
 * @property text $description
 * @property tinyInteger $published
*/
class Quiz extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'published','answer_publish','answer_view','attempts_no','course_id', 'lesson_id', 'start_at', 'end_at', 'time', 'time_type', 'full_marks', 'pass_marks','remaining_marks','quiz_type'];


    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLessonIdAttribute($input)
    {
        $this->attributes['lesson_id'] = $input ? $input : null;
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')->withTrashed();
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_quiz')->withTrashed();
    }

    public function teachers()
    {
        return $this->belongsToMany(Admin::class, 'quiz_user');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'quiz_student')->withTimestamps();
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class,'quiz_id', 'id');
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

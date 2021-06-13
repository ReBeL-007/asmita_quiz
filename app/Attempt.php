<?php

namespace App;

use App\Quiz;
use App\User;
use App\AttemptAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attempt extends Model
{
    use SoftDeletes;

    public $table = 'attempts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quiz_id',
        'status',
        'user_id',
        'feedback',
        'total_marks',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function attemptAnswers()
    {
        return $this->hasMany(AttemptAnswer::class, 'attempt_id')->withTrashed();
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

}

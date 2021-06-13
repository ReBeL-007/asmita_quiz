<?php

namespace App;

use App\AttemptOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttemptAnswer extends Model
{
    use SoftDeletes;

    public $table = 'attempt_answers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'attempt_id',
        'question_id',
        'marks',
        'feedback',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function attemptOptions()
    {
        return $this->hasMany(AttemptOption::class, 'attempt_answer_id')->withTrashed();
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class, 'attempt_id')->withTrashed();
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }

}

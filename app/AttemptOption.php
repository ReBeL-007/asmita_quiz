<?php

namespace App;

use App\Option;
use App\AttemptAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttemptOption extends Model
{
    use SoftDeletes;

    public $table = 'attempt_options';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'attempt_answer_id',
        'option_id',
        'answer_text',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function attemptAnswer()
    {
        return $this->belongsTo(AttemptAnswer::class, 'attempt_answer_id')->withTrashed();
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id')->withTrashed();
    }
}

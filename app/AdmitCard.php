<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    public $table = 'admit_cards';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'registration_no',
        'symbol_no',
        'student_name',
        'college',
        'department',
        'semester',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

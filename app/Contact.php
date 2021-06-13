<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    //
    use SoftDeletes;

    protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];
  
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'contact',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //  public function getRouteKeyName() {
    //      return 'slug';
    //  }
}

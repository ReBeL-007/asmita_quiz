<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    //
    use SoftDeletes;

    protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];
  
    protected $fillable = [
        'title',
        'slug',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function permissions() {

    //     return $this->belongsToMany(Permission::class,'roles_permissions');
            
    //  }
     
     public function admins() {
     
        return $this->belongsToMany(Admin::class,'admins_groups');
            
     }

     public function getRouteKeyName() {
         return 'slug';
     }
}

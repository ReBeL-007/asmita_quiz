<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
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
      'created_at',
      'updated_at',
      'deleted_at',
  ];

    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
            
     }
     
     public function admins() {
     
        return $this->belongsToMany(Admin::class,'admins_permissions');
            
     }

     public function getRouteKeyName() {
       
          return 'slug';
      }
}

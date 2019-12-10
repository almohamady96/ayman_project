<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function user(){
        //1- class -> App\User
        //2- table which connect the two tables -> user_roles
        //3- foreign key -> role_id
        //4- related id -> user_id
        return $this->belongsToMany('App\User','user_roles','role_id','user_id');
    }
}

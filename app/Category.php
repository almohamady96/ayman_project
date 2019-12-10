<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function article(){
        return $this->hasMany('App\Article');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function mainCategory(){
        return $this->hasMany('App\Category','category_id');
    }


}

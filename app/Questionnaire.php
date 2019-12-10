<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    //
    public function vote(){
        return $this->hasMany('App\QuestionnaireVote');
    }
}

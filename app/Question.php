<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'bar_id', 'questionnaire_title', 'first_question', 'sec_question'
    ];
}
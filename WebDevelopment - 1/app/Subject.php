<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    function getQuestions() {
        return Question::where('subject', $this->id)->orderBy('id', 'asc')->get();
    }

    static function getSubjects() {
        return DB::table('subjects')->orderBy('id', 'asc')->get();
    }
}

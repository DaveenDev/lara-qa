<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute(){
        return  \Parsedown::instance()->text($this->body);
     }

    public static function boot(){
        parent::boot();

        //create an event handler when Answer is created

        static::created(function($answer){
            $answer->question->increment('answers_count');
        });

        //saved event handle
        static::saved(function ($answer){
            
        });
    }
}

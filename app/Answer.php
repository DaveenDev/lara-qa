<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    use Functions;

    protected $fillable=['body','user_id'];
    protected $appends = ['created_date'];
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute(){
        //parse the markdown into html ex. \n into <br>
       return  \Parsedown::instance()->text($this->body);
    }

       public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute(){
        return $this->isBest();
    }

    public function isBest(){
        return $this->id===$this->question->best_answer_id;
    }


    public static function boot(){
        parent::boot();

        static::created(function ($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::deleted(function ($answer){
            $questio=$answer->question;
            $answer->question->decrement('answers_count');
            
            //check if the deleted answer was the best answer, then replace the best answer ID to null
            if($question->best_answer_id===$answer->id){
                $question->best_answer_id=NULL;
                $question->question->save();
            }
        });
    }

   
}

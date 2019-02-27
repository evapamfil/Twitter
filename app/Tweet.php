<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function user(){
        return $this->belongsTo(User::Class);
    }
}

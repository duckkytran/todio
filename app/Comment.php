<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "Comment";

    public function goitin(){
    	return $this->belongsTo('App\GoiTin','idGoitin','id');
    }

    public function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
}

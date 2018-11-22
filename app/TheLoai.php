<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "TheLoai";
    public function goitin(){
    	return $this->hasMany('App\GoiTin','idTheloai','id');
    }
}

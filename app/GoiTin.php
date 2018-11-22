<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoiTin extends Model
{
    protected $table = "GoiTin";
    public function theloai(){
    	return $this->belongsTo('App\TheLoai','idTheloai','id');
    }

    public function comment(){
    	return $this->hasMany('App\Comment','idGoitin','id');
    }
    public function khuvuc(){
    	return $this->hasOne('App\KhuVuc','idKhuvuc','id');
    }
}

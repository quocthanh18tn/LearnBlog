<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";

    public function loaitin()
    {
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    // table the loai co nhieu loai tin, khoa phu loai tin, khoa chinh id
    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}

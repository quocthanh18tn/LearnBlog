<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoaiTin;
use Illuminate\Support\Facades\Validator;
use App\TheLoai;
class AjaxController extends Controller
{
    //
     public function getLoaiTin($idTheLoai)
    {
        $loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();
        foreach ($loaitin as $lt) {
           echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    }


}


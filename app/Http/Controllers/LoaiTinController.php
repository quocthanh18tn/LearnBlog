<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoaiTin;
use Illuminate\Support\Facades\Validator;
use App\TheLoai;
class LoaiTinController extends Controller
{
    //
     public function getDanhSach()
    {
    	$loaitin= LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','thanh cong roi nha');
    }

    public function getThem()
    {
    	$theloai= TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
    			'TheLoai'=>'required',
    		],
    		[
    			'Ten.required'=>"chua nhap ten loai tin",
    			'Ten.unique'=>" ten da ton tai",
    			'Ten.min' =>' ban chon qua ngan',
    			'Ten.max' =>' ban chon qua dai',
    			'TheLoai.required'=> " chua chon the loai"
    		]);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten=$request->Ten;
    	$loaitin->TenKhongDau=changeTitle($request->Ten);
    	$loaitin->idTheloai=$request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/them')->with('thongbao','ban dda them thanh cong');

    }
    public function getSua($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$theloai= TheLoai::all();
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
    			'TheLoai'=>'required',
    		],
    		[
    			'Ten.required'=>"chua nhap ten loai tin",
    			'Ten.unique'=>" ten da ton tai",
    			'Ten.min' =>' ban chon qua ngan',
    			'Ten.max' =>' ban chon qua dai',
    			'TheLoai.required'=> " chua chon the loai"
    		]);
    	$loaitin = LoaiTin::find($id);
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai=$request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','thanh cong roi ne');
    }
}


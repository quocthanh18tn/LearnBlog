<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\TheLoai;
use Illuminate\Support\Facades\Validator;


class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	$theloai= TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }


    public function getThem()
    {
        return view('admin.theloai.them');

    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'ban chua nhap ten the loai',
                'Ten.min'=>'qua ngan',
                'Ten.max'=>'qua dai',
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao',' Thêm thành công');
    }
    public function getSua($id)
    {
        $theloai =  TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
            ],
            [
                'Ten.required'=>'ban chua nhap ten',
                'Ten.unique'=>'the loai da ton tai',
                'Ten.min'=>'qau ngan',
                'Ten.max'=>'qau dai',
            ]);
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau=changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$theloai->id)->with('thongbao','thanh cong roi nha');
    }
     public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','thanh cong roi nha');
    }
}

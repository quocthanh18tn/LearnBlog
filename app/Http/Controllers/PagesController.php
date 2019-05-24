<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\Loaitin;
use App\TinTuc;
use View;
class PagesController extends Controller
{
    //
    function __construct()
    {
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
        $this->middleware(function ($request, $next) {
            if (Auth::check())
            {
                View::share('nguoidung',Auth::user());
            }
            return $next($request);
        });
    }

    function trangchu()
    {
    	return view('pages/trangchu');
    }
    function lienhe()
    {
    	return view('pages/lienhe');
    }
    function loaitin($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaitin',$id)->paginate(5);
    	return view('pages/loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);

    }
     function tintuc($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages/tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);

    }
    function getDangnhap()
    {
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request)
    {
         $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required',
            ],
            [
                'email.required' => ' bạn chưa nhập email',
                'password.required' => ' ban chựa nhập mat khau',
            ]); 
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
          return redirect('trangchu');
        }
        else
          return redirect('dangnhap')->with('thongbao','dang nhap khong dc');
        

    }
     function getdangxuat()
    {
        Auth::logout();
        return redirect('trangchu');
    }

    function getnguoidung()
    {
        return view('pages.nguoidung');
    }
    function postnguoidung()
    {

    }
    function timkiem(Request $request)
    {
        $tukhoa=$request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}

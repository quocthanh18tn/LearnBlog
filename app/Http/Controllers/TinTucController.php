<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id')->limit(5)->get();
		// $tintuc = TinTuc::orderBy('id','DESC')->limit(5)->get();
		return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem()
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required',
            ],
            [
                'LoaiTin.required' =>' chua chọn loại tin',
                'TieuDe.required' => ' bạn chưa nhập tiêu đề',
                'TieuDe.unique' => ' tiêu đề tồn tại',
                'TomTat.required' => ' ban chựa nhập',
                'NoiDung.required' => ' ban chựa nhập',
            ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem=0;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png')
            {
                return redirect('admin/tintuc/them')->with('thongbao','Loi hinh up sai roi');   
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists('upload/tintuc/'.$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->Hinh=$Hinh;
        }
        else
            $tintuc->Hinh = "";

        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao','them tin thanh cong');   
    }
    public function getSua($id)
    {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id)
    {
        $tintuc = TinTuc::find($id);
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required',
            ],
            [
                'LoaiTin.required' =>' chua chọn loại tin',
                'TieuDe.required' => ' bạn chưa nhập tiêu đề',
                'TieuDe.unique' => ' tiêu đề tồn tại',
                'TomTat.required' => ' ban chựa nhập',
                'NoiDung.required' => ' ban chựa nhập',
            ]);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png')
            {
                return redirect('admin/tintuc/them')->with('thongbao','Loi hinh up sai roi');   
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists('upload/tintuc/'.$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh=$Hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','sua xong rồi');   

    }
    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao','xóa xong rồi');
    }
}

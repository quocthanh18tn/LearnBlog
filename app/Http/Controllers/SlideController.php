<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem()
    {
        return view('admin.slide.them');
    }
    public function postThem(Request $request)
    {
         $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung'=>'required',
                'Link'=>'required',
            ],
            [
                'Ten.required' =>' chua chọn loại tin',
                'NoiDung.required' => ' bạn chưa nhập tiêu đề',
                'Link.required' => ' ban chựa nhập',
            ]);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png')
            {
                return redirect('admin/slide/them')->with('thongbao','Loi hinh up sai roi');   
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists('upload/slide/'.$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('upload/slide',$Hinh);
            $slide->Hinh=$Hinh;
        }
        else
            $slide->Hinh = "";

        $slide->save();

        return redirect('admin/slide/them')->with('thongbao','them tin thanh cong');   
        
    }
    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id)
    {
        
       $slide = Slide::find($id);
       $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung'=>'required',
                'Link'=>'required',
            ],
            [
                'Ten.required' =>' chua chọn loại tin',
                'NoiDung.required' => ' bạn chưa nhập tiêu đề',
                'Link.required' => ' ban chựa nhập',
            ]);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png')
            {
                return redirect('admin/slide/sua/'.$id)->with('thongbao','Loi hinh up sai roi');   
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists('upload/slide/'.$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move('upload/slide',$Hinh);
            $slide->Hinh=$Hinh;
        }

        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('thongbao','them tin thanh cong');   
          
    }
    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao','xoa thanh cong');
    }
}

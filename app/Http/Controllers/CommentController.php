<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;
use App\TinTuc;

class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','thanh congcomment roi nha');
    }

    public function postcomment($id,Request $request)
    {
    	$idTinTuc=$id;
    	$tintuc = TinTuc::find($id);
    	$comment = new Comment;
    	$comment->idTinTuc=$idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung=$request->NoiDung;
    	$comment->save();

    	return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','thanh cong roi nha');
    }
}


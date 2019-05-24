@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
               @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('thongbao'))
                        <div class = "alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            <option value="">Select</option>
                            @foreach ($theloai as $tl)
                                <option
                                @if ($tl->id == $tintuc->loaitin->theloai->id)
                                 {{"selected"}}
                                @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin </label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                          @foreach ($loaitin as $lt)
                            <option
                            @if ($lt->id == $tintuc->loaitin->id)
                                {{"selected"}}
                            @endif
                            value="{{$lt->id}}">{{$lt->Ten}}</option>
                          @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Tiêu đề" value="{{$tintuc->TieuDe}}">
                    </div>

                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="form-control ckeditor" id="demo" rows="3" name="TomTat" >{{$tintuc->TomTat}}</textarea>
                    </div>

                   <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" class="form-control ckeditor"  rows="5" name="NoiDung" >{{$tintuc->NoiDung}}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <img src="upload/tintuc/{{$tintuc->Hinh}}" width="300px" >
                        <br>
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0"
                                @if($tintuc->NoiBat==0)
                                {{"checked"}}
                                @endif
                              type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1"
                             @if($tintuc->NoiBat==1)
                                {{"checked"}}
                                @endif
                                 type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        {{-- comment --}}
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Comment</small>
                </h1>
            </div>
             @if (session('thongbao'))
                        <div class = "alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>{{$cm->user->name}}</td>
                        <td>{{$cm->NoiDung}}</td>
                        <td>{{$cm->created_at}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        {{-- emdcomment --}}
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


@endsection

@section('script')
    <script >
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                var idTheLoai= $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection
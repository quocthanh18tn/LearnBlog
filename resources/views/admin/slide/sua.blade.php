@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>{{$slide->Ten}}</small>
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
                <form action="admin/slide/sua/{{$slide->id}} " method="POST" enctype="multipart/form-data">
                @csrf
                   
                    <div class="form-group">
                        <label>Ten</label>
                        <input class="form-control" name="Ten" placeholder="Please Enter Category Name" value="{{$slide->Ten}}" />
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                         <textarea class="form-control ckeditor" id="demo" rows="3" name="NoiDung" >{{$slide->NoiDung}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <img src="upload/slide/{{$slide->Hinh}}" width="300px" >
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Please Enter Category Name"  value="{{$slide->link}}" />
                    </div>

                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection
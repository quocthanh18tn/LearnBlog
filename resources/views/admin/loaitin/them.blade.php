@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loai tin
                    <small>Them</small>
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
                <form action="admin/loaitin/them" method="POST">
                @csrf
                    <div class="form-group">
                        <label>The loai</label>
                        <select class="form-control" name="TheLoai">
                            @foreach($theloai as $tl)
                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ten loai tin</label>
                        <input class="form-control" name="Ten" placeholder="Nhap ten loai tin" />
                    </div>
                  
                    <button type="submit" class="btn btn-default">Add</button>
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
@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
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
                <form action="admin/user/them" method="POST">
                 @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter  Name" />
                    </div>
                    <div class="form-group">
                        <label> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Please Enter  email" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Please Enter  Keywords" />
                    </div>
                    <div class="form-group">
                        <label>Password again</label>
                        <input type="password" class="form-control" name="password2" placeholder="Please Enter  Keywords" />
                    </div>

                   
                    <div class="form-group">
                        <label>Priviledg</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" checked="" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" type="radio">Not admin
                        </label>
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
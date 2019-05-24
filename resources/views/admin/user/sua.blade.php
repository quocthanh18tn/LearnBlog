@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{$user->name}}</small>
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
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                 @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter  Name" value="{{$user->name}}" />
                    </div>
                    <div class="form-group">
                        <label> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Please Enter  email" value="{{$user->email}}" readonly="" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="changePassword" name="changePassword">
                        <label>Change password</label>
                        <input type="password" class="form-control password" name="password" placeholder="Please Enter  Keywords" disabled="" />
                    </div>
                    <div class="form-group">
                        <label>Password again</label>
                        <input type="password" class="form-control password" name="password2" placeholder="Please Enter  Keywords" disabled=""/>
                    </div>

                   
                    <div class="form-group">
                        <label>Priviledg</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" 
                            @if ($user->quyen ==1)
                            {{"checked"}}
                            @endif
                             type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                            @if ($user->quyen ==0)
                            {{"checked"}}
                            @endif
                            type="radio">Not admin
                        </label>
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

@section('script')
<script>
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');
            }
            else
            {
                $(".password").attr('disabled','');
            }
        });
    });
</script>
@endsection
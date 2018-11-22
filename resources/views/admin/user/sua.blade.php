@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>{{ $user->name }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(count($errors) >0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                  {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                                
                            </div>
                        @endif
                       
                           
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/sua/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Nhập họ tên người dùng"
                                value="{{ $user->name }}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Nhập địa chỉ email"
                                value="{{ $user->email }}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword">

                                <label>Đổi mật khẩu</label>
                                <input class="form-control password"  type="password" name="password" placeholder="Nhập mật khẩu" disabled />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control password"  type="password" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled />
                            </div>

                            <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio"
                                    @if($user->quyen ==0) {{ "checked" }}
                                    @endif
                                    >Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio"
                                    @if($user->quyen ==0) {{ "checked" }}
                                    @endif
                                    >Người dùng
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
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
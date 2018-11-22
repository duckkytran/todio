@extends('layout.index')

@section('content')
  <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
				  	<div class="panel-body">
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
				    	<form action="dangky" method="post">
				    		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
							  	>
							</div>
							 <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control"  name="sdt" placeholder="Nhập số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Website</label>
                                <input class="form-control" name="website" placeholder="Nhập địa chỉ website" />
                            </div>
							<br>	
							<div>
								<input type="checkbox" class="" name="checkpassword">
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
							</div>
							<div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control" name="avatar" />
                            </div>
                            <div class="form-group">
                                <label>Ảnh bìa</label>
                                <input type="file" class="form-control" name="banner" />
                            </div>
							<br>
							<button type="submit" class="btn btn-default">Đăng ký
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection
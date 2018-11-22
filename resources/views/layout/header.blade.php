@push('styles')
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">
    @endpush

   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Responsive mobile -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu"> Todio.vn</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="gioithieu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="khuyenmai">Khuyến mãi</a>
                    </li>
                    <li>
                        <a href="lienhe">Liên hệ</a>
                    </li>
                </ul>
{{-- Thanh tìm kiếm --}}
                <form action="timkiem" method="post" class="navbar-form navbar-left" role="search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Nhập từ khóa cần tìm">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm kiếm</button>
			    </form>

{{-- Thông báo lổi đăng nhập --}}
                @if(count($errors) >0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                      {{ $err }}<br>
                    @endforeach
                </div>
            @endif
            @if(session('thongbao'))
                    {{ session('thongbao') }}
            @endif
			    <ul class="nav navbar-nav pull-right">
                    @if(Auth::check() == null){
                        <li>
                            <a href="dangky">Đăng ký</a>
                        </li>
                        <li>
                            <div class="w3-container">   
                          <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-blue w3-large">Đăng nhập</button>

                          <div id="id01" class="w3-modal">
                            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                              <div class="w3-center"><br>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <img src="image/logo/avtlogin.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
                              </div>

                              <form class="w3-container" action="dangnhap" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="w3-section">
                                  <label><b>Email</b></label>
                                  <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Nhập email của bạn" name="email">
                                  <label><b>Mật khẩu</b></label>
                                  <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password">
                                  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Đăng nhập</button>
                                  <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Nhớ mật khẩu
                                </div>
                              </form>
                              <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Hủy</button>
                                <span class="w3-right w3-padding w3-hide-small"><a href="#">Quên mật khẩu?</a></span>
                              </div>
                            </div>
                          </div>
                        </div>
                    </li>
                    }
                    @else
                    {
                    <li>
                    	<a href="nguoidung"><span class ="glyphicon glyphicon-user"></span>    {{ Auth::user()->name }}</a>
                    </li>
                    <li>
                    	<a href="dangxuat">Đăng xuất</a>
                    </li>
                    }
                    @endif
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
   
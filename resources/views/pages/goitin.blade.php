@extends('layout.index')

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-lg-9">
	        <h1>{{ $goitin->TieuDe }}</h1>
	        <p class="lead">
	            by <a href="#">Start Bootstrap</a>
	        </p>
	        <img class="img-responsive" src="../image/anh-ab/ab1.jpg" alt="">
	        <p><span class="glyphicon glyphicon-time"></span> Ngày đăng: {{ $goitin->created_at }}</p>
	        <hr>

	        <!-- Post Content -->
	        <p class="lead">
	        	{{ $goitin->NoiDung }}
	        </p>
	        <hr>
	        <div class="well">
	            <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
	            <form role="form">
	                <div class="form-group">
	                    <textarea class="form-control" rows="3"></textarea>
	                </div>
	                <button type="submit" class="btn btn-primary">Gửi</button>
	            </form>
	        </div>

	        <hr>

	        <!-- Comment -->
	        @foreach($goitin->comment as $cm)
	        <div class="media">
	            <a class="pull-left" href="#">
	                <img class="media-object" src="{{ $cm->user->avatar }}" alt="">
	            </a>
	            <div class="media-body">
	                <h4 class="media-heading">{{ $cm->user->idUser }}
	                    <small>{{ $cm->created_at }}</small>
	                </h4>
	                {{ $cm->NoiDung }}
	            </div>
	        </div>
	        @endforeach
	      

	    </div>

	    <!-- Blog Sidebar Widgets Column -->
	    <div class="col-md-3">

	        <div class="panel panel-default">
	            <div class="panel-heading"><b>Tin liên quan</b></div>
	            <div class="panel-body">

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->
	            </div>
	        </div>

	        <div class="panel panel-default">
	            <div class="panel-heading"><b>Tin nổi bật</b></div>
	            <div class="panel-body">

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->

	                <!-- item -->
	                <div class="row" style="margin-top: 10px;">
	                    <div class="col-md-5">
	                        <a href="detail.html">
	                            <img class="img-responsive" src="image/320x150.png" alt="">
	                        </a>
	                    </div>
	                    <div class="col-md-7">
	                        <a href="#"><b>Project Five</b></a>
	                    </div>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                    <div class="break"></div>
	                </div>
	                <!-- end item -->
	            </div>
	        </div>
	        
	    </div>

	</div>
        <!-- /.row -->
</div>
@endsection
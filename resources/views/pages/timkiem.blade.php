@extends('layout.index')

@section('content')
   <div class="container">
        <div class="row">
           
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm kiếm: {{ $tukhoa }}</b></h4>
                    </div>
                    @foreach($goitin as $gt)
                    <div class="row-item row">
                        <div class="col-md-3">
                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="image/anh-ab" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{ $gt->TieuDe }}</h3>
                            <p>{{ $gt->TomTat }}</p>
                            <a class="btn btn-primary" href="goitin/{{ $gt->id }}/{{ $gt->TieuDeKhongDau }}.html">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <div style="text-align: center">
                    	{{ $goitin->links() }}

                 	
                    </div>
                    	
                </div>
            </div> 

        </div>

    </div>
@endsection
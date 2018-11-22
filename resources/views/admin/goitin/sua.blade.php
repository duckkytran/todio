@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Gói tin
                            <small>{{ $goitin->TieuDe }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <!-- Bắt lỗi -->
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

                        <form action="admin/goitin/sua/{{ $goitin->id }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" 
                                placeholder="Nhập tiêu đề" value="{{ $goitin->TieuDe }}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control" rows="3"
                                value="{{ $goitin->TomTat }}" ></textarea>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5" 
                                value="{{ $goitin->NoiDung }}"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <img width="400px" src="upload/goitin/{{ $goitin->Hinh }}"><br>
                                <input type="file" class="form-control" name="Hinh" />
                            </div>

                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" 
                                    @if($goitin->NoiBat==0)
                                        {{ "checked" }}
                                    @endif
                                    type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                     @if($goitin->NoiBat==0)
                                        {{ "checked" }}
                                    @endif
                                    type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection 
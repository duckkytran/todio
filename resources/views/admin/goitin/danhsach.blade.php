@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Gói Tin
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                                
                            </div>
                        @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Ảnh đại diện</th>
                                <th>Tóm tắt</th>
                                <th>Thể loại</th>
                                <th>Lượt xem</th>
                                <th>Nổi bật</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goitin as $gt)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $gt->id }}</td>
                                <td>{{ $gt->TieuDe }}</td>
                                <td>
                                    <img width="100px" src="image/goitin/{{ $gt->Hinh }}">
                                </td>
                                <td>{{ $gt->TomTat }}</td>
                                <td>{{ $gt->idTheloai  }}</td>
                                <td>{{ $gt->SoLuotXem }}</td>
                                <td>
                                    @if($gt->NoiBat==0){{ 'Không' }}
                                    @else {{ 'Có' }}
                                    @endif
                                </td>
                                
                                <td class="center"><i class="fa fa-trash" aria-hidden="true"></i><a href="admin/goitin/xoa/{{ $gt->id }}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/goitin/sua/{{ $gt->id }}">Sửa</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
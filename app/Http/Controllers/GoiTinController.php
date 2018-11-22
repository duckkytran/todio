<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\GoiTin;
use App\Comment;

class GoiTinController extends Controller
{
    public function getDanhSach(){
    	//Hiện hết tin cuối cùng, sắp xếp giảm dần 'DESC' theo 'id'
    	$goitin = GoiTin::orderBy('id','DESC')->get();
    	return view('admin.goitin.danhsach',['goitin'=>$goitin]);
    }


//Thể loại/ Thêm
    public function getThem(){
    	$theloai = TheLoai::all();
    	return view('admin.goitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request){
        $theloai = TheLoai::all();
        $goitin = GoiTin::all();
    	$this->validate($request,[
    		'TieuDe'=>'required|min:3|unique:GoiTin,TieuDe',
    		'NoiDung'=>'required',
    		'TomTat'=>'required'
    	],
    	[
    		'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
       		'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
    		'TieuDe.unique'=>'Tiêu đề đã tồn tại',
    		'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    		'NoiDung.required'=>'Bạn chưa nhập nội dung'	
    	]);
    	$goitin = new GoiTin;
    	$goitin->TieuDe = $request->TieuDe;
    	$goitin->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$goitin->TomTat = $request->TomTat;
    	$goitin->NoiDung = $request->NoiDung;
        $goitin->idTheloai = $request->idTheloai;

    	//Upload hình
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		//Ngoại lệ đuôi ảnh
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){
    			return redirect('admin/goitin/them')->with('loi','File đã chọn không phải file hình	');
    		}
    		//Lưu tên của hình
    		$name = $file->getClientOriginalName();
    		//Đặt lại tên k trùng, cho random 4 ktự 
    		$Hinh = str_random(4)."_".$name;
    		//Lưu hình vào máy
    		$file->move("image/goitin",$Hinh);
    		$goitin->Hinh = $Hinh;

    	}
    	else {
    		$goitin->Hinh= "";
    	}
    	$goitin->save();
    	return redirect('admin/goitin/them')->with('thongbao','Thêm tin thành công');
    }


//Thể loại/ Sửa
    public function getSua($id){
    	$theloai = TheLoai::all();
    	$goitin = GoiTin::find($id);
    	//Xem trang sửa
    	return view('admin.goitin.danhsach',['goitin'=>$goitin])->with('thongbao','Sửa tin thành công');
    }

    public function postSua($id, Request $request){
    	$goitin = GoiTin::find($id);
    	$this->validate($request,[
    		'TieuDe'=>'required|min:3|unique:GoiTin,TieuDe',
    		'NoiDung'=>'required',
    		'TomTat'=>'required'
    	],
    	[
    		'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    		'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
    		'TieuDe.unique'=>'Tiêu đề đã tồn tại',
    		'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    		'NoiDung.required'=>'Bạn chưa nhập nội dung'	
    	]);
    	$goitin->TieuDe = $request->TieuDe;
    	$goitin->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$goitin->TomTat = $request->TomTat;
    	$goitin->NoiDung = $request->NoiDung;

    	//Upload hình
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		//Ngoại lệ đuôi ảnh
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){
    			return redirect('admin/goitin/them')->with('loi','File đã chọn không phải file hình	');
    		}
    		//Lưu tên của hình
    		$name = $file->getClientOriginalName();
    		//Đặt lại tên k trùng, cho random 4 ktự 
    		$Hinh = str_random(4)."_".$name;
    		unlink("upload/goitin/".$goitin->Hinh);
    		//Lưu hình vào máy
    		$file->move("upload/goitin",$Hinh);
    		$goitin->Hinh = $Hinh;

    	}
    	
    	$goitin->save();
    	return view('admin/goitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$goitin = GoiTin::find($id);
    	$goitin->delete();
    	return redirect('admin/goitin/danhsach')->with('thongbao','Xóa thành công');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }


//Thể loại/ Thêm
    public function getThem(){
    	return view('admin.theloai.them');
    }
    public function postThem(Request $request){
    	//Bắt lổi nhập thể loại
    	$this->validate($request,
    		[
    			'Ten'=> 'required|min:3|max:50'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên thể loại',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 50 ký tự',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 50 ký tự'
    		]);
    	//Sau khi bắt lỗi xong lấy 'Ten' lưu vào model TheLoai
    	//Đổi tên có dấu thành không dấu
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	//Chuyển hướng thông báo
    	return redirect('admin/theloai/danhsach')->with('thongbao','Thêm thành công');
    }


//Thể loại/ Sửa
    public function getSua($id){
    	//Tìm id để sửa
    	$theloai = TheLoai::find($id);
    	//Xem trang sửa
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua($id, Request $request){
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		[
    			'Ten'=> 'required|unique:TheLoai,Ten|min:3|max:50'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên thể loại',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 50 ký tự',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 50 ký tự'
    		]);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	//Chuyển hướng thông báo
    	return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$theloai = TheLoai::find($id);
    	$theloai->delete();
    	return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa thành công');
    }
}

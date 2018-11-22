<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }


//Thể loại/ Thêm
    public function getThem(){
    	return view('admin.slide.them');
    }
    public function postThem(Request $request){
    	//Bắt lổi nhập thể loại
    	$this->validate($request,
    		[
    			'Ten'=> 'required',
                'NoiDung'=> 'required',
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên slide',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
    		]);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        //Ng dùng có thể k thêm link slide
        if($request->has('link'))
            $slide->link = $request->link;

    	//Upload hình
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            //Ngoại lệ đuôi ảnh
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('loi','File đã chọn không phải file hình ');
            }
            //Lưu tên của hình
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("image/slide/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            //Đặt lại tên k trùng, cho random 4 ktự 
            
            //Lưu hình vào máy
            $file->move("image/slide",$Hinh);
            $slide->Hinh = $Hinh;

        }
        else {
            $slide->Hinh= "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm tin thành công');
    	
    	
    }


//Thể loại/ Sửa
    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua($id, Request $request){
    	//Bắt lổi nhập thể loại
        $this->validate($request,
            [
                'Ten'=> 'required',
                'NoiDung'=> 'required',
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên slide',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
            ]);
        $slide =  Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        //Ng dùng có thể k thêm link slide
        if($request->has('link'))
            $slide->link = $request->link;

        //Upload hình
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            //Ngoại lệ đuôi ảnh
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){
                return redirect('admin/slide/them')->with('loi','File đã chọn không phải file hình ');
            }
            //Lưu tên của hình
            $name = $file->getClientOriginalName();
            //Đặt lại tên k trùng, cho random 4 ktự 
            $hinh = str_random(4)."_".$name;
            unlink("upload/slide/".$slide->Hinh);
            //Lưu hình vào máy
            $file->move("upload/images/slide",$hinh);
            $slide->Hinh = $hinh;

        }
        
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
    }
}

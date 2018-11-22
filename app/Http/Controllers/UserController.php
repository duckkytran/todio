<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Sử dụng lớp đăng nhập

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use App\Http\Controllers\bcrypt;


class UserController extends Controller
{
    public function getDanhSach(){
        //Biến user = Model User
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }


//Thể loại/ Thêm
    public function getThem(){
    	return view('admin.user.them');
    }
    public function postThem(Request $request){
    	//Bắt lổi nhập thể loại
    	$this->validate($request,
    		[
    			'name'=> 'required|min:3',
                'email'=> 'required',
                'password'=>'required|min:3|max:16',
                'passwordAgain'=>'required|same:password'

    		],
    		[
    			'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng có ít nhất 3 ký tự',
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Bạn chưa nhập đúng định dạng email',
                'email.unique'=>'Email đã tồn tại',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có từ 3-16 ký tự',
                'password.max'=>'Mật khẩu phải có từ 3-16 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Nhập khẩu nhập lại không khớp'
    		]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sdt = $request->sdt;
        $user->website = $request->website;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->avatar = $request->avatar;
        $user->banner = $request->banner;

         if($request->hasFile('banner'))
        {
            $file = $request->file('banner');
            //Ngoại lệ đuôi ảnh
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/user/them')->with('loi','File đã chọn không phải file hình ');
            }
            //Lưu tên của hình
            $name = $file->getClientOriginalName();
            $banner= str_random(4)."_".$name;
            while(file_exists("image/user/".$banner))
            {
                $banner = str_random(4)."_".$name;
            }
            //Đặt lại tên k trùng, cho random 4 ktự 
            
            //Lưu hình vào máy
            $file->move("image/user",$banner);
            $user->banner = $banner;

        }
        else {
            $user->banner= "";
        }
       

        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            //Ngoại lệ đuôi ảnh
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/user/them')->with('loi','File đã chọn không phải file hình ');
            }
            //Lưu tên của hình
            $name = $file->getClientOriginalName();
            $avatar= str_random(4)."_".$name;
            while(file_exists("image/user/".$avatar))
            {
                $avatar = str_random(4)."_".$name;
            }
            //Đặt lại tên k trùng, cho random 4 ktự 
            
            //Lưu hình vào máy
            $file->move("image/user",$avatar);
            $user->avatar = $avatar;

        }
        else {
            $user->avatar = "";
        }

        $user->save();

        return redirect('admin/user/them')->with('thongbao','Thêm người dùng thành công');
    	
    	
    }


//Thể loại/ Sửa
    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua($id, Request $request){
    	//Bắt lổi nhập thể loại
        $this->validate($request,
            [
                'name'=> 'required|min:3',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng có ít nhất 3 ký tự',
                
            ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

        if($request->changePassword == "on")
        {
           $this->validate($request,
            [
                'password'=>'required|min:3|max:16',
                'passwordAgain'=>'required|same:password'

            ],
            [
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có từ 3-16 ký tự',
                'password.max'=>'Mật khẩu phải có từ 3-16 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Nhập khẩu nhập lại không khớp'
            ]);
            $user->password = bcrypt($request->password);
        }
        
        
        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa người dùng thành công');
    }

    public function getXoa($id){
    	$user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa người dùng thành công');
    }

    public function getDangnhapAdmin(){
        return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request){
        $this->validate($request,
            [
                'email'=> 'required',       
                'password'=>'required|min:3|max:16'

            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có từ 3-16 ký tự',
                'password.max'=>'Mật khẩu phải có từ 3-16 ký tự'
                
            ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }

    }

    public function getDangxuatAdmin(){
        Auth::logout();
        return redirect('admin/getDangnhapAdmin');
    }
}

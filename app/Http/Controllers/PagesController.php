<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\bcrypt;
use App\TheLoai;
use App\Slide;
use App\GoiTin;
use App\User; 
class PagesController extends Controller
{
	function __construct()
	{
		$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);

        if(Auth::check())
        {
            view()->share('nguoidung',Auth::user());

        }
        
	}

    function trangchu()
    {
    	
    	return view('pages.trangchu');
    }
    function timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $goitin = GoiTin::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['goitin'=>$goitin,'tukhoa'=>$tukhoa]);
    }

    function goitin($id)
    {
        $theloai = TheLoai::all();
        $goitin = GoiTin::find($id);
        //lấy 4 tin nổi bật
        $tinnoibat = GoiTin::where('NoiBat',1)->take(4)->get();
        // $tinlienquan = GoiTin::where('idTheloai',$goitin->idTheloai)->take(4)->get();
        // DB::table('goitin')->where('id', $id)->update(['SoLuotXem' => $goitin->SoLuotXem+1]); //Tăng lượt xem
        return view('pages.goitin',['goitin'=>$goitin,'tinnoibat'=>$tinnoibat]);//,'tinlienquan'=>$tinlienquan]);
    }

    function getDangnhap()
    {
        return view('pages.trangchu');
    }
    function postDangnhap(Request $request)
    {
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
            return redirect('trangchu');
        }
        else
        {
            return redirect('trangchu')->with('thongbao','Đăng nhập không thành công');
        }
    }

    function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    function getNguoidung(){
        $user = User::all();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }
     function postNguoidung(Request $request){
         $this->validate($request,
            [
                'name'=> 'required|min:3',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng có ít nhất 3 ký tự',
                
            ]);

        $user = Auth::user();
        // $user->name = Request::input('name');
        $user->name = $request->name;

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
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');
    }

    function getDangky()
    {
        return view('pages.dangky');
    }

    function postDangky(Request $request)
    {
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
        $user->quyen = 0;
        $user->avatar = $request->avatar;
        $user->banner = $request->banner;

         if($request->hasFile('banner'))
        {
            $file = $request->file('banner');
            //Ngoại lệ đuôi ảnh
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('dangky')->with('loi','File đã chọn không phải file hình ');
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
                return redirect('dangky')->with('loi','File đã chọn không phải file hình ');
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
        return redirect('dangky')->with('thongbao','Chúc mừng bạn đã đăng ký thành công!');
    }
 }

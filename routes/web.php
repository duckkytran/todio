<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});

//Route đăng nhập
Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');

//Route đăng xuất
Route::get('admin/dangxuat','UserController@getDangxuatAdmin');


Route::group(['prefix'=>'admin'], function(){
	Route::group(['prefix'=>'theloai'],function(){
		//get: dùng để gọi trang đó
		//post: dùng để gửi dữ liệu lên server
		//admin/theloai/...
		Route::get('danhsach','TheLoaiController@getDanhSach');

		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');

		//Truyen id cho 'sua' để biết đang sửa chổ nào
		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua');

		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix'=>'goitin'],function(){
		//admin/goitin/...
		Route::get('danhsach','GoiTinController@getDanhSach');

		Route::get('them','GoiTinController@getThem');
		Route::post('them','GoiTinController@postThem');

		//Truyen id cho 'sua' để biết đang sửa chổ nào
		Route::get('sua/{id}','GoiTinController@getSua');
		Route::post('sua/{id}','GoiTinController@postSua');

		Route::get('xoa/{id}','GoiTinController@getXoa');
	});
//Route Slide
	Route::group(['prefix'=>'slide'],function(){
		//admin/slide/
		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		//Truyen id cho 'sua' và 'xoađể biết đang sửa chổ nào
		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('xoa/{id}','SlideController@getXoa');
	});
//Route User
	Route::group(['prefix'=>'user'],function(){
		//admin/user/...
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		//Truyen id cho 'sua' để biết đang sửa chổ nào
		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('xoa/{id}','UserController@getXoa');
	});
});

//Trang chủ

Route::get('trangchu','PagesController@trangchu');
Route::get('goitin/{id}/{TieuDeKhongDau}','PagesController@goitin');


Route::get('dangnhap','PagesController@getDangnhap');
Route::post('dangnhap','PagesController@postDangnhap');
Route::get('dangxuat','PagesController@getDangxuat');
Route::get('dangky','PagesController@getDangky');
Route::post('dangky','PagesController@postDangky');

Route::get('nguoidung','PagesController@getNguoidung');
Route::post('nguoidung','PagesController@postNguoidung');

Route::post('timkiem','PagesController@timkiem');

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

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get','post'],'/register', 'frontend\RegisterController@register');
Route::get('/login', 'frontend\RegisterController@accountLogin')->name('login');
Route::post('/login', 'frontend\RegisterController@checklogin');
Route::get('logout', 'frontend\RegisterController@logout')->name('logout');
Route::get('refreshCaptcha', 'frontend\RegisterController@refreshCaptcha')->name('refresh');
Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => 'user-portal'], function () {
	Route::get('/', function(){
		return view('frontend.dashboard.dashboard');
	});
	Route::get('/dashboard', 'frontend\DashboardController@index');
  Route::match(['get','post'],'/manage-profile', 'frontend\DashboardController@show');
  Route::match(['get','post'],'/manage-profile-tutor', 'frontend\DashboardController@show_tutor');
  Route::post('/profile/picture', 'frontend\DashboardController@profilePicture');
  Route::get('/students', 'frontend\StudentController@show');
  Route::match(['get','post'],'student/add','frontend\StudentController@addEditStudent');
  Route::match(['get','post'],'student/edit/{id}','frontend\StudentController@addEditStudent');
  Route::delete('student/delete','frontend\StudentController@deleteStudent');
  Route::get('/aggreements','frontend\DashboardController@getAggreements');
  Route::get('/view_aggreement/{id}','frontend\DashboardController@ViewAggreementDetails');
  Route::get('/show_aggreement/{id}','frontend\DashboardController@showAggreement');
  Route::post('/sign-agreement','frontend\DashboardController@SignAggreement');

  });
});
/////////////////////////////// Admin //////////////////////////////
Route::match(['get','post'],'/admin/login', 'Admin\AdminController@admin_login');
Route::group(['middleware' => ['auth'=>'admin']], function () {
Route::group(['prefix' => 'dashboard'], function () {
	Route::get('/', function(){
		return view('/admin.index');
	 });
Route::match(['get','post'],'/logout', 'Admin\AdminController@logout');
Route::match(['get','post'],'/view_admins','Admin\AdminController@all_admin');
Route::match(['get','post'],'admin/add','Admin\AdminController@addEditAdmin');
Route::match(['get','post'],'admin/edit/{id}','Admin\AdminController@addEditAdmin');
Route::delete('admin/delete','Admin\AdminController@deleteAdmin');

Route::match(['get','post'],'/view_customers','Admin\AdminController@all_customers');
Route::match(['get','post'],'customer/add','Admin\AdminController@addEditCustomer');
Route::match(['get','post'],'customer/edit/{id}','Admin\AdminController@addEditCustomer');
Route::delete('customer/delete','Admin\AdminController@deleteCustomer');

Route::match(['get','post'],'/view_students','Admin\AdminController@all_students');
Route::match(['get','post'],'student/add','Admin\AdminController@addEditStudent');
Route::match(['get','post'],'student/edit/{id}','Admin\AdminController@addEditStudent');
Route::delete('student/delete','Admin\AdminController@deleteStudent');

Route::match(['get','post'],'/view_tutors','Admin\AdminController@all_tutors');
Route::match(['get','post'],'tutor/add','Admin\AdminController@addEditTutor');
Route::match(['get','post'],'tutor/edit/{id}','Admin\AdminController@addEditTutor');
Route::delete('tutor/delete','Admin\AdminController@deleteTutor');

Route::match(['get','post'],'/view_aggreements','Admin\AdminController@all_aggreement');
Route::match(['get','post'],'aggreement/add','Admin\AdminController@addEditAggreement');
Route::match(['get','post'],'aggreement/edit/{id}','Admin\AdminController@addEditAggreement');
Route::delete('aggreement/delete','Admin\AdminController@deleteAggreement');
Route::get('/show_aggreement/{id}','Admin\AdminController@showAggreement');
Route::get('/get_all_user/{id}','Admin\AdminController@getUserList');
Route::get('/sendAggreement/{id}/{userID}','Admin\AdminController@sendAggreement');

Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));
 });
});

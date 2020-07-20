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
  Route::get('/agreements','frontend\DashboardController@getAgreements');
  Route::get('/view_agreement/{id}','frontend\DashboardController@ViewAgreementDetails');
  Route::get('/show_agreement/{id}','frontend\DashboardController@showAgreement');
  Route::post('/sign-agreement','frontend\DashboardController@SignAgreement');
  Route::get('/faqs','frontend\DashboardController@faqs');
  Route::get('/credits','frontend\DashboardController@credits');
  Route::post('/buy-credit','frontend\DashboardController@buyCredit');
  Route::post('/subscribe_process', 'frontend\DashboardController@subscribe_process');
  Route::get('/tutors', 'frontend\DashboardController@studentTutor');
  Route::get('/tutor-students', 'frontend\DashboardController@TutorStudents');
  Route::get('/unsubscribe-email', 'frontend\DashboardController@UnsubscribeEmail');
  Route::get('/unsubscribe-email-confirm', 'frontend\DashboardController@UnsubscribeEmailConfirm');
  Route::get('/tutor-sessions', 'frontend\DashboardController@tutorSessions');
  Route::match(['get','post'],'session/add','frontend\DashboardController@addEditSession');
  Route::match(['get','post'],'session/edit/{id}','frontend\DashboardController@addEditSession');
  Route::get('/gettutorCallenderData', 'frontend\DashboardController@get_session_data');
  Route::get('/tutor-sessions-details/{id}', 'frontend\DashboardController@tutorSessionsDetails');
  Route::post('end-session','frontend\DashboardController@EndSession');
  Route::delete('cancel-session','frontend\DashboardController@CancelSession');
  Route::get('/client-sessions', 'frontend\DashboardController@clientSessions');
  Route::get('/getclientCallenderData', 'frontend\DashboardController@get_clientSession_data');
  Route::get('/client-sessions-details/{id}', 'frontend\DashboardController@ClientSessionsDetails');
  Route::post('/client-cancel-session', 'frontend\DashboardController@ClientCancelSession');
  Route::get('/checkCredit/{id}', 'frontend\DashboardController@checkCredit');
  Route::get('/tutor-timesheets', 'frontend\DashboardController@tutorTimesheets');
  Route::get('/gettutorTimesheetsCallenderData', 'frontend\DashboardController@getTimesheetData');
  Route::match(['get','post'],'timesheet/add','frontend\DashboardController@addEditTimeSheet');
  Route::match(['get','post'],'timesheet/edit/{id}','frontend\DashboardController@addEditTimeSheet');
  Route::get('/tutor-timesheet-details/{id}', 'frontend\DashboardController@tutorTimesheetDetails');
  Route::delete('delete-timesheet','frontend\DashboardController@deleteTimesheet');

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
///////////////////// Clients ////////////////////////
Route::match(['get','post'],'/view_customers','Admin\AdminController@all_customers');
Route::match(['get','post'],'customer/add','Admin\AdminController@addEditCustomer');
Route::match(['get','post'],'customer/edit/{id}','Admin\AdminController@addEditCustomer');
Route::delete('customer/delete','Admin\AdminController@deleteCustomer');
///////////////////// Students ////////////////////////
Route::match(['get','post'],'/view_students','Admin\AdminController@all_students');
Route::match(['get','post'],'student/add','Admin\AdminController@addEditStudent');
Route::match(['get','post'],'student/edit/{id}','Admin\AdminController@addEditStudent');
Route::delete('student/delete','Admin\AdminController@deleteStudent');
///////////////////// Tutors ////////////////////////
Route::match(['get','post'],'/view_tutors','Admin\AdminController@all_tutors');
Route::match(['get','post'],'tutor/add','Admin\AdminController@addEditTutor');
Route::match(['get','post'],'tutor/edit/{id}','Admin\AdminController@addEditTutor');
Route::delete('tutor/delete','Admin\AdminController@deleteTutor');
///////////////////// Agreements ////////////////////////
Route::match(['get','post'],'/view_agreements','Admin\AdminController@all_agreement');
Route::match(['get','post'],'agreement/add','Admin\AdminController@addEditAgreement');
Route::match(['get','post'],'agreement/edit/{id}','Admin\AdminController@addEditAgreement');
Route::delete('agreement/delete','Admin\AdminController@deleteAgreement');
Route::get('/show_agreement/{id}','Admin\AdminController@showAgreement');
Route::get('/get_all_user/{id}','Admin\AdminController@getUserList');
Route::get('/sendAgreement/{id}/{userID}','Admin\AdminController@sendAgreement');
Route::match(['get','post'],'/awaiting_signature','Admin\AdminController@awaiting_signature_agreements');
Route::match(['get','post'],'/signed_agreements','Admin\AdminController@signed_agreements');
Route::delete('pending-agreement/delete','Admin\AdminController@deletePendingAgreement');

Route::match(['get','post'],'/FAQ','Admin\AdminController@addEditFAQ');
Route::get('/get_all_tutors/{id}','Admin\AdminController@getTutorList');
Route::post('AssignTutor','Admin\AdminController@AssignTutor');
Route::get('/DeleteAssignTutor/{id}/{tutor_id}','Admin\AdminController@DeleteAssignTutor');
/////////////////////// Sessions ////////////////////
Route::match(['get','post'],'/view_sessions', 'Admin\AdminController@AdminSessions');
Route::match(['get','post'],'session/add','Admin\AdminController@addEditSession');
Route::match(['get','post'],'session/edit/{id}','Admin\AdminController@addEditSession');
Route::get('/getAdminCallenderData', 'Admin\AdminController@get_session_data');
Route::get('/get-assignStudent/{id}', 'Admin\AdminController@getAssingStudent');
Route::delete('cancel-session','Admin\AdminController@CancelSession');
Route::get('/session-details/{id}', 'Admin\AdminController@getSessionDetails');
Route::get('/tutor-sessions/{id}', 'Admin\AdminController@tutorSessions');
Route::get('/getAdminTutorCallenderData/{id}', 'Admin\AdminController@get_tutor_session_data');
///////////////////////////// Timesheets///////////////////////////
Route::match(['get','post'],'/view_timesheets', 'Admin\AdminController@AdminTimesheets');
Route::get('/getAdminTimesheetsCallenderData', 'Admin\AdminController@getTimesheetData');
Route::get('/timesheet-details/{id}', 'Admin\AdminController@getTimesheetDetails');
Route::match(['get','post'],'timesheet/add','Admin\AdminController@addEditTimeSheet');
Route::match(['get','post'],'timesheet/edit/{id}','Admin\AdminController@addEditTimeSheet');
Route::delete('delete-timesheet','Admin\AdminController@deleteTimesheet');
Route::get('/tutor-timesheets/{id}', 'Admin\AdminController@tutorTimesheets');
Route::get('/getTutorTimesheetCallenderData/{id}', 'Admin\AdminController@get_tutor_timesheet_data');
Route::match(['get','post'],'/view_reports', 'Admin\AdminController@AdminReports');
Route::get('/tutor_reports/{id}', 'Admin\AdminController@tutorReports');

 });
});

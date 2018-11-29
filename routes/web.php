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
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
Route::get('/send_email', array('uses' => 'EmailController@sendEmailReminder'));
Route::get('admin/email', 'MailController@showEmailForm');
Route::post('admin/email', 'MailController@sendEmail');

// Route::get('/', 'UserController@testViewSendMail')->name('user.view-mail');
// Route::post('/', 'UserController@testSendMail')->name('user.send-mail');

// Route::get('/', function () { return view('welcome');})->name('logout');
Route::get('/login', function () { return view('auth.login');})->name('login');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::post('/home/test-post-man', 'HomeController@testPostMan');


//Password reset routes
Route::get('seller_password/reset', 'SellerAuth\ForgotPasswordController@showLinkRequestForm')->name('seller.forgotpassword');
Route::post('seller_password/email', 'SellerAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('seller_password/reset/{token}', 'SellerAuth\ResetPasswordController@showResetForm');
Route::post('seller_password/reset', 'SellerAuth\ResetPasswordController@reset');




Route::group(['middleware' => 'auth'], function() {

    Route::post('product/search', 'ProductController@search')->name('product.search');
    Route::resource('/product', 'ProductController');
    Route::get('product/{product}', 'ProductController@show')->name('product.show');
    Route::get('product/{product}/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('product/{product}/{id}/update', 'ProductController@update')->name('product.update');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::delete('product/{id}/destroy', 'ProductController@destroy')->name('product.destroy');

    Route::resource('/news', 'NewsController');

    Route::get('user/{user}/ajax-edit', 'UserController@ajaxEdit')->name('user.ajax-edit');
    Route::put('user/{user}/ajax-update', 'UserController@ajaxUpdate')->name('user.ajax-update');
    Route::resource('/user', 'UserController');

    

});

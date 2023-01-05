<?php

use Illuminate\Support\Facades\Route;


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
Route::get('/foo', function () {
    Artisan::call('storage:link');
    });
Route::get('/welcome',function(){
    return view('welcome');
});
Auth::routes(['register'=>false]);

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::post('password-reset', 'FrontendController@showResetForm')->name('password.reset');
// Socialite
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@home')->name('home');
Route::get('/-{langg}','FrontendController@lang')->name('lang');

// Frontend Routes
Route::get('/home', 'FrontendController@index')->name('home');
Route::get('/berita-{judul}', 'FrontendController@berita');
Route::get('/pages-{semua}', 'FrontendController@pages');
Route::get('/petasitus-{lang}','FrontendController@peta')->name('petasitus');
Route::get('/cari','FrontendController@cari');
Route::get('/pengumuman-{peng}','FrontendController@pengumuman');
Route::get('/berita-search','FrontendController@beritaSearch')->name('berita.search');
Route::get('/category-{cat}', 'FrontendController@category')->name('category-berita');

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users','UsersController');
    // role route
    Route::resource('roles','RolesController');
    // Banner
    Route::resource('banner','BannerController');
    // Sosmed
    Route::resource('sosmed','SosmedController');
    // Aplikasi
    Route::resource('aplikasi','AplikasiController');
    // Pejabat
    Route::resource('pejabat','PejabatController');
    // Visitor
    Route::resource('/visitor','VisitorController');
    // Log
    Route::resource('/log','LogController');
    // Agenda
    Route::resource('agenda','AgendaController');
    // Brand
    Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');

    // Product
    Route::resource('/product','ProductController');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    //POST MENU
    Route::resource('/menu','MenuController');
    // POST language
    Route::resource('/language','LanguageController');
    // POST widget
    Route::resource('/widget','WidgetController');
    // POST Pages
    Route::resource('/pages','PagesController');
    // POST Galeri
    Route::resource('/galeri','GaleriController');
    // POST Link
    Route::resource('/link','LinkController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    Route::resource('/post','PostController');
    // Pengumuman
    Route::resource('/pengumuman','PengumumanController');
    // Comment
    Route::resource('/comment','PostCommentController');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');
    Route::resource('/level','LevelController');
    // Jabatan
    Route::resource('/jabatan','JabatanController');
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::get('setting/{bhs}','AdminController@edit')->name('edit.settings');

    //Route::get('settings/{lang}','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form.adm');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password.adm');
});
















// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    // Product Review
    Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form.usr');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password.usr');

});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

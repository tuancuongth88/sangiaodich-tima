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
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', ['uses' => 'Administrators\Authenticate\AuthController@getLogin'])->name('login');
Route::post('admin/login', ['uses' => 'Administrators\Authenticate\AuthController@postLogin']);
Route::get('admin/logout', ['uses' => 'Administrators\Authenticate\AuthController@getLogout']);
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
//route need permission
// Route::group(['prefix' => 'administrator', 'middleware' => 'authenticate'], function () {
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //system route

    Route::get('partner-category/search', 'Administrators\Partner\PartnerCategoryController@getSearch');
    Route::resource('/partner-category', 'Administrators\Partner\PartnerCategoryController');

    Route::get('partner/search', 'Administrators\Partner\PartnerController@getSearch');
    Route::resource('/partner', 'Administrators\Partner\PartnerController');

    Route::resource('/dashboard', 'Administrators\Systems\DashboardController');
    //news route
    Route::get('/news/search', 'Administrators\News\NewsController@getSearch');
    Route::resource('/news-category', 'Administrators\News\NewsCategoryController');
    Route::resource('/news', 'Administrators\News\NewsController');
    Route::post('/upload', 'Administrators\Systems\UploadController@postUpload');
    Route::put('/news/accept/{id}', 'Administrators\News\NewsController@putApprove');
    // Route::get('/news/search', 'Administrators\News\NewsController@getSearch');
    //faq route
    Route::get('/faq/search', 'Administrators\Projects\ProjectController@getSearch');
    Route::resource('/faq', 'Administrators\Faqs\FaqController');
    //project route

    Route::get('contact/search', 'Administrators\Contact\ContactController@getSearch');
    Route::resource('/contact', 'Administrators\Contact\ContactController');
    //user route
    Route::get('/user/search', 'Administrators\Users\UserController@getSearch');
    Route::get('/user/search-data', 'Administrators\Users\UserController@getSearchData');
    Route::resource('/user', 'Administrators\Users\UserController');
    Route::get('/search', 'Administrators\Systems\DashboardController@getSearch');
});

Route::resource('template', 'Frontends\Homes\HomeController');

Route::get('/tin-tuc/danh-muc/{id}', 'Frontends\News\NewsController@getNewsByCategory');
Route::get('/tin-tuc/chi-tiet/{slug}', 'Frontends\News\NewsController@getDetail');
Route::get('/tin-tuc/view-more', 'Frontends\News\NewsController@getViewMore');
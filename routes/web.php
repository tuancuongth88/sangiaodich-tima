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
    // Route::post('/upload', 'Administrators\Systems\UploadController@postUpload');
    Route::put('/news/accept/{id}', 'Administrators\News\NewsController@putApprove');
    // Route::get('/news/search', 'Administrators\News\NewsController@getSearch');
    //faq route
    // Route::get('/faq/search', 'Administrators\Projects\ProjectController@getSearch');
    Route::resource('/faq-categories', 'Administrators\Faqs\FaqCategoriesController');
    Route::resource('/faq', 'Administrators\Faqs\FaqController');
    //project route

    Route::get('contact/search', 'Administrators\Contact\ContactController@getSearch');
    Route::resource('/contact', 'Administrators\Contact\ContactController');
    //user route
    Route::get('/user/search', 'Administrators\Users\UserController@getSearch');
    Route::get('/user/search-data', 'Administrators\Users\UserController@getSearchData');
    Route::resource('/user', 'Administrators\Users\UserController');
    Route::get('/search', 'Administrators\Systems\DashboardController@getSearch');

    Route::resource('/service', 'Administrators\Services\ServiceController');
    // Manage location, city, district
    Route::get('/location', 'Administrators\Systems\DashboardController@getLocation');
    Route::post('/location', 'Administrators\Systems\DashboardController@postLocation');
});

Route::resource('home', 'Frontends\Homes\HomeController');

Route::get('/tin-tuc/danh-muc/{id}', 'Frontends\News\NewsController@getNewsByCategory');
Route::get('/tin-tuc/chi-tiet/{slug}', 'Frontends\News\NewsController@getDetail');
Route::get('/tin-tuc/view-more', 'Frontends\News\NewsController@getViewMore');



Route::get('/transactionhistory/search', 'Frontends\TransactionHistory\TransactionHistoryController@getTranByProduct');
Route::get('/tra-cuu-lich-su-vay-no', 'Frontends\TransactionHistory\TransactionHistoryController@searchTranByPhoneAndIdCard');
Route::get('/quan-ly-don-vay', 'Frontends\TransactionHistory\TransactionHistoryController@manage');
Route::get('/quan-ly-don-vay/search', 'Frontends\TransactionHistory\TransactionHistoryController@m_search');
Route::get('/lich-su-don-vay/updatestatus', 'Frontends\TransactionHistory\TransactionHistoryController@updateStatus');
Route::get('/quan-ly-don-vay/updatestatus', 'Frontends\TransactionHistory\TransactionHistoryController@updateStatus');
Route::resource('lich-su-don-vay', 'Frontends\TransactionHistory\TransactionHistoryController');


// Route for User Member
Route::group(['prefix' => 'user'], function () {
    Route::get('/register', 'Frontends\Users\UsersController@getRegisterForm');
    Route::post('/register', 'Frontends\Users\UsersController@postRegisterForm');
    Route::post('/register-otp', 'Frontends\Users\UsersController@validateOTP');
});

// Route dang ky vay
Route::get('/dang-ky-vay/{service}', 'Frontends\Services\ServicesController@registerForm');
Route::post('/dang-ky-vay', 'Frontends\Services\ServicesController@postRegisterForm');


// Route for all ajax
Route::group(['prefix' => 'ajax'], function () {
    Route::post('/get-district-by-city', 'AjaxController@getDistrictByCity');
});




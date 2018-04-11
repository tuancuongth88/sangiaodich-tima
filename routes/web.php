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

// Auth::routes();
Route::get('admin/login', ['uses' => 'Administrators\Authenticate\AuthController@getLogin'])->name('login');
Route::post('admin/login', ['uses' => 'Administrators\Authenticate\AuthController@postLogin']);
Route::get('admin/logout', ['uses' => 'Administrators\Authenticate\AuthController@getLogout']);
//route need permission
// Route::group(['prefix' => 'administrator', 'middleware' => 'authenticate'], function () {
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //system route
    Route::resource('/', 'Administrators\Systems\DashboardController');

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
/////////////////////////////////// END ADMIN PAGE ////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// START FRONTEND ///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});
Route::resource('home', 'Frontends\Homes\HomeController');

Route::get('/tin-tuc/danh-muc/{id}', 'Frontends\News\NewsController@getNewsByCategory');
Route::get('/tin-tuc/chi-tiet/{slug}', 'Frontends\News\NewsController@getDetail');
Route::get('/tin-tuc/view-more', 'Frontends\News\NewsController@getViewMore');

Route::get('/transactionhistory/search', 'Frontends\TransactionHistory\TransactionHistoryController@getTranByProduct');
Route::get('/tra-cuu-lich-su-vay-no', 'Frontends\TransactionHistory\TransactionHistoryController@searchTranByPhoneAndIdCard');
Route::get('/quan-ly-don-vay', 'Frontends\TransactionHistory\TransactionHistoryController@manage')->name('frontends.manager.transaction');
Route::get('/quan-ly-don-vay/search', 'Frontends\TransactionHistory\TransactionHistoryController@m_search');
Route::get('/lich-su-don-vay/updatestatus', 'Frontends\TransactionHistory\TransactionHistoryController@updateStatus');
Route::get('/quan-ly-don-vay/updatestatus', 'Frontends\TransactionHistory\TransactionHistoryController@updateStatus');
Route::resource('lich-su-don-vay', 'Frontends\TransactionHistory\TransactionHistoryController');


/*
|-------------------------------------------
| ROUTE FOR USER IN FRONTEND
|-------------------------------------------
| @options register, login, edit profile
| @author tantan
*/
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'Frontends\Users\UsersController@getLoginForm')->name('frontend.user.register')->middleware('guest');

    Route::get('/register', 'Frontends\Users\UsersController@getRegisterForm')->name('frontend.user.register')->middleware('guest');
    Route::post('/register', 'Frontends\Users\UsersController@postRegisterForm')->name('frontend.user.store');
    Route::post('/register-otp', 'Frontends\Users\UsersController@validateOTP');

    Route::get('/login', 'Frontends\Users\UsersController@getLoginForm')->name('frontend.user.login')->middleware('guest');
    Route::get('/logout', 'Frontends\Users\usersController@logout')->name('frontend.user.logout')->middleware('auth');
    Route::post('/login', 'Frontends\Users\UsersController@postloginForm')->name('frontend.user.dologin');

    /*
    |-------------------------------------------
    | EDIT PROFILE INFO OF AN USER
    |-------------------------------------------
    | @params user_id
    | @method GET POST
    | @author tantan
    */
    Route::get('/{user}/edit', 'Frontends\Users\UsersController@getProfileForm')->name('frontend.user.edit')->middleware('owner');
    Route::post('/{user}/edit', 'Frontends\Users\UsersController@postProfileForm')->name('frontend.user.doedit')->middleware('owner');


    //  Save list sercice to an user
    Route::post('/{user}/edit/save-services', 'Frontends\Users\UsersController@postSaveService')->name('frontend.user.save_service')->middleware('owner');

    //  Save list district to an user
    Route::post('/{user}/edit/save-locations', 'Frontends\Users\UsersController@postSaveLocation')->name('frontend.user.save_location')->middleware('owner');

    Route::post('/{user}/update-user-info-lender', 'Frontends\Users\UsersController@updateUserInfo')->name('frontend.user.update-user-info-lender')->middleware('owner');
    Route::post('/uploadavatar', 'Frontends\Users\UsersController@uploadAvatar');
    Route::post('/uploadimage', 'Frontends\Users\UsersController@uploadimgprofile');
});

/*
|-------------------------------------------
| DANG KY VAY
|-------------------------------------------
| @options get list of service, dang ky vay
| @author tantan
*/
Route::group(['prefix' => 'dang-ky-vay'], function () {
    Route::get('/', 'Frontends\Services\ServicesController@index')->name('services.site.list');
    Route::get('/{service}', 'Frontends\TransactionHistory\TransactionHistoryController@registerForm')->name('services.site.form');
    Route::post('/register/{service}', 'Frontends\TransactionHistory\TransactionHistoryController@postRegisterForm')->name('services.site.register');

    /// bo sung thong tin cho don vay
    Route::get('/{service}/transaction/{transaction}', 'Frontends\TransactionHistory\TransactionHistoryController@transactionUpdateForm')->name('transaction.site.updateform');
    Route::post('/{service}/transaction/{transaction}', 'Frontends\TransactionHistory\TransactionHistoryController@postTransactionUpdateForm')->name('transaction.site.post_updateform');
});

// Route for all ajax
Route::group(['prefix' => 'ajax'], function () {
    Route::post('/get-district-by-city', 'AjaxController@getDistrictByCity');
    Route::post('/get-ward-by-district', 'AjaxController@getWardByDistrict');
});


Route::group(['prefix' => 'san-giao-dich'], function (){
   Route::get('/', 'Frontends\TransactionHistory\ListTransactionController@index');
});


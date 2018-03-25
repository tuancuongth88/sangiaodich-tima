<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('/login', ['uses' => 'Authenticate\AuthController@postLogin']);
//     Route::get('/logout', ['uses' => 'Authenticate\AuthController@getLogout']);
//     Route::get('verify', ['uses' => 'Authenticate\AuthController@verify']);

// });

// Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {
//     Route::resource('/user', 'User\UserController');
//     Route::resource('/news-category', 'News\NewsCategoryController');
//     Route::resource('/news', 'News\NewsController');
//     Route::group(['prefix' => 'systems'], function () {
//         Route::get('branch/branch-and-department/{id}', ['uses' => 'Systems\BranchController@destroyBranchAndDepartments']);
//         Route::resource('/branch', 'Systems\BranchController');
//         Route::resource('/department', 'Systems\DepartmentController');
//         Route::resource('/position', 'Systems\PositionController');
//     });
// });
Route::get('test', function () {
    return 2222;
});
// Route::get('/user/test', ['uses' => 'User\UserController@getTest'])->middleware('jwt.auth');
// Route::resource('/user', 'User\UserController');

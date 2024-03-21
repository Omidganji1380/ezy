<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/v1/getUsers', function () {
//    $users = \App\Models\User::all();
//    return response()->json($users);
//});
//Route::get('/v1/getUsers/{id}', function ($id) {
//    $users = \App\Models\User::findOrFail($id);
//    return response()->json($users);
//});
Route::group(['prefix' => '/v1/auth'], function () {
    Route::post('p', ['\App\Http\Controllers\api\v1\Auth', 'sendSms']);
    Route::post('login', '\App\Http\Controllers\api\v1\Auth@login');
    Route::post('logout', '\App\Http\Controllers\api\v1\Auth@logout');
});
Route::group(['prefix' => '/v1/dashboard'], function () {
    Route::post('/', '\App\Http\Controllers\api\v1\PageBuilder\Dashboard@getProfiles');
    Route::post('/getImg', '\App\Http\Controllers\api\v1\PageBuilder\Dashboard@getProfileImg');
});

//$token = 'FX)zt6(T@Pt`,%-[Pb00j`|L7Cj6+*f';
//Route::group(['middleware' => 'api'/*,'prefix' => $token*/], function () {
//
//});
//Route::post('/v1/auth/{phone}', ['\App\Http\Controllers\api\v1\Auth', 'sendSms']);
//Route::resource('/v1/auth/{phone}',\App\Http\Controllers\api\v1\Auth::class);

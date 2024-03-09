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
Route::get('/v1/getUsers', function () {
    $users = \App\Models\User::all();
    return response()->json($users);
});
Route::get('/v1/getUsers/{id}', function ($id) {
    $users = \App\Models\User::findOrFail($id);
    return response()->json($users);
});
$token='lS_Hp~wrQjdm;9*JEv0sfFrCpN734stkHV-|ea|8PVT[J$CMt(;+L"66CrR%@(4Ne+-j29EQ`km(NDe=i=]5=w0SzIVRoD=WV<tr';
Route::group(['middleware' => 'api','prefix' => $token],function (){
    Route::get('/v1/auth/{phone}', ['\App\Http\Controllers\api\v1\Auth', 'sendSms']);

});
//Route::post('/v1/auth/{phone}', ['\App\Http\Controllers\api\v1\Auth', 'sendSms']);
//Route::resource('/v1/auth/{phone}',\App\Http\Controllers\api\v1\Auth::class);

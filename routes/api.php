<?php

use App\Http\Controllers\api\v1\DigitalMenu\DigitalMenuController;
use App\Http\Controllers\api\v1\Home\Slider;
use App\Http\Controllers\api\v1\PageBuilder\Dashboard;
use App\Http\Controllers\api\v1\PageBuilder\Edit;
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

Route::middleware('auth:sanctum')
     ->get('/user', function (Request $request) {
         return $request->user();
     });


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('p', [\App\Http\Controllers\api\v1\Auth::class, 'sendSms']);
        Route::post('login', [\App\Http\Controllers\api\v1\Auth::class, 'login']);
        Route::post('logout', [\App\Http\Controllers\api\v1\Auth::class, 'logout']);
    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/', [Dashboard::class, 'getProfiles']);
        Route::post('/getView', [Dashboard::class, 'getView']);
        Route::post('/getAllReservedLinks', [Dashboard::class, 'getAllReservedLinks']);
        Route::post('/submitNewProfile', [Dashboard::class, 'submitNewProfile']);
    });
    Route::group(['prefix' => 'pb'], function () {
        Route::post('edit', [Edit::class, 'pageBuilderEdit']);
        Route::post('addPbOption', [Edit::class, 'addPbOption']);
        Route::post('sorting', [Edit::class, 'sorting']);
        Route::post('deleteBlock', [Edit::class, 'deleteBlock']);
        Route::post('deleteBlockItem', [Edit::class, 'deleteBlockItem']);
        Route::post('updateHeaderProfile', [Edit::class, 'updateHeaderProfile']);
    });
    Route::group(['prefix' => 'home'], function () {
        Route::get('getSliders', [Slider::class, 'getSliders']);
    });
    Route::group(['prefix' => 'digitalMenu'], function () {
        Route::post('getDigitalMenus', [DigitalMenuController::class, 'getDigitalMenus']);
        Route::post('/submitNewMenu', [DigitalMenuController::class, 'submitNewMenu']);
        Route::post('/edit', [DigitalMenuController::class, 'edit']);

    });
});

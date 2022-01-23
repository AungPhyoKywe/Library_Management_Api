<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'],function () {

    Route::group( ['prefix'=>'/user','middleware'=>['guest:api'],'namespace'=>'Api' ],function(){
        Route::post('/login',[ AuthController::class, 'login' ]);
        Route::post('/register',[ AuthController::class, 'register' ]);
    });
    Route::group( ['prefix'=>'/user','middleware'=>['auth:api'],'namespace'=>'Api' ],function(){
        Route::get('/logout',[AuthController::class,'logout']);
        Route::post('/update-profile',[AuthController::class,'update_profile']);
        Route::post('/update-profile-pic',[AuthController::class,'update_profile_pic']);
        Route::get('/user-list-for-select2',[AuthController::class,'user_list_for_select2']);
    });

});
Route::get('/test-data',function () {
    return ['user' => 'test'];
});

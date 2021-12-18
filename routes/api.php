<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['prefix' => 'parentauth', 'middleware' => ['cors', 'throttle:60,10']], function($api) {

        $api->post('test', 'App\Api\V1\Controllers\TestController@test');
        
        $api->post('signup', 'App\Api\V1\Controllers\Auth\SignUpController@register');
        $api->post('viewPlans', 'App\Api\V1\Controllers\PublicController@viewPlans');
        $api->post('requestOtp', 'App\Api\V1\Controllers\Auth\SignUpController@requestOtp');
        $api->post('verifyOtp', 'App\Api\V1\Controllers\Auth\SignUpController@verifyOtp');
        $api->post('login', 'App\Api\V1\Controllers\Auth\LoginController@login')->name('login');
        $api->post('logout', 'App\Api\V1\Controllers\Auth\LogoutController@logout');

        $api->post('refresh', 'App\Api\V1\Controllers\Auth\RefreshController@refresh');

        // $api->post('recovery', 'App\Api\V1\Controllers\Auth\ForgotPasswordController@sendResetEmail');
        // $api->post('checkResetPasswordToken', 'App\Api\V1\Controllers\Auth\ResetPasswordController@checkResetPasswordToken');
        // $api->post('reset', 'App\Api\V1\Controllers\Auth\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => ['auth:sanctum', 'cors']], function($api) {
        $api->post('viewProfile', 'App\Api\V1\Controllers\Auth\UserController@viewProfile');
        $api->post('updateProfile', 'App\Api\V1\Controllers\Auth\UserController@updateProfile');
        $api->post('uploadProfileImage', 'App\Api\V1\Controllers\Auth\UserController@uploadProfileImage');
        $api->post('changePassword', 'App\Api\V1\Controllers\Auth\UserController@changePassword');


        $api->group(['middleware' => []], function($api) {

        });

    });


    // Route::get('/demo-url',  function  (Request $request)  {
    //     return response()->json(['Laravel 8 CORS Demo']);
    //  });

    $api->get('hello', function () {
        return response()->json([
            'message' => 'Laravel 8 CORS Demo',
        ]);
    });

});

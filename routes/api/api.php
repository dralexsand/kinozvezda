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

    /*Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });*/


    Route::post(
        '/filter',
        [
            'App\Http\Controllers\Api\v1\FilterController',
            'getFilteredData'
        ]
    );

    Route::post(
        '/upload',
        [
            'App\Http\Controllers\Api\v1\UploadController',
            'uploadData'
        ]
    );


    Route::post(
        '/filter/avatars',
        [
            'App\Http\Controllers\Api\v1\FilterController',
            'getFilteredDataAvatars'
        ]
    );

    Route::get(
        '/profile/{id}',
        [
            'App\Http\Controllers\Api\v1\FilterController',
            'getDataProfile'
        ]
    );

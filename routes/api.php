<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\PingController as PingV1;
use App\Http\Controllers\v1\BuildingController as BuildingV1;
use App\Http\Controllers\v1\ImageController as UploadImageV1;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {

    Route::get('/ping', [PingV1::class, 'index']);

    Route::get('/building', [BuildingV1::class, 'get']);
    Route::get('/building/{id}', [BuildingV1::class, 'getByID']);
    Route::delete('/building/{id}', [BuildingV1::class, 'destroy']);
    Route::post('/building/add', [BuildingV1::class, 'add']);

    // /**
    //  * company
    //  */
    // Route::get('/company/{id}', [CompanyV1::class, 'get']);

    Route::prefix('/uploadImage')->group(function () {
        Route::get('/', [UploadImageV1::class, 'get']);
        Route::get('/{id}', [UploadImageV1::class, 'getById']);
        Route::post('/', [UploadImageV1::class, 'store']);
        Route::put('/{id}', [UploadImageV1::class, 'update']);
        Route::delete('/{id}', [UploadImageV1::class, 'destroy']);
    });

});

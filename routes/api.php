<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\PingController as PingV1;
use App\Http\Controllers\v1\BuildingController as BuildingV1;
use App\Http\Controllers\v1\ServicesController as ServicesV1;
use App\Http\Controllers\v1\UploadImageController as UploadImageV1;
use App\Http\Controllers\v1\PricesController as PricesV1;
use App\Models\UploadImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    Route::delete('/building/delete/{id}', [BuildingV1::class, 'destroy']);
    Route::post('/building/add', [BuildingV1::class, 'add']);

    Route::get('/services', [ServicesV1::class, 'get']);
    Route::get('/services/{id}', [ServicesV1::class, 'getByID']);
    Route::delete('/services/delete/{id}', [ServicesV1::class, 'destroy']);
    Route::post('/services/add', [ServicesV1::class, 'add']);
    Route::put('/services/update/{id}', [ServicesV1::class, 'update']);

    Route::get('/prices', [PricesV1::class, 'get']);
    Route::get('/prices/{id}', [PricesV1::class, 'getByID']);
    Route::delete('/prices/delete/{id}', [PricesV1::class, 'destroy']);
    Route::post('/prices/add', [PricesV1::class, 'add']);
    Route::put('/prices/update/{id}', [PricesV1::class, 'update']);

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

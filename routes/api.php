<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\PingController as PingV1;
use App\Http\Controllers\v1\BuildingController as BuildingV1;
use App\Http\Controllers\v1\ServicesController as ServicesV1;
use App\Http\Controllers\v1\UploadImageController as UploadImageV1;
use App\Http\Controllers\v1\PricesController as PricesV1;
use App\Http\Controllers\v1\BookingController as BookingV1;
use App\Http\Controllers\v1\OrderController as OrderV1;
use App\Http\Controllers\v1\RoomController as RoomV1;
use App\Http\Controllers\v1\SearchController as SearchV1;
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

    Route::get('/service', [ServicesV1::class, 'get']);
    Route::get('/service/{id}', [ServicesV1::class, 'getByID']);
    Route::delete('/service/delete/{id}', [ServicesV1::class, 'destroy']);
    Route::post('/service/add', [ServicesV1::class, 'add']);
    Route::put('/service/update/{id}', [ServicesV1::class, 'update']);

    Route::get('/prices', [PricesV1::class, 'get']);
    Route::get('/prices/{id}', [PricesV1::class, 'getByID']);
    Route::delete('/prices/delete/{id}', [PricesV1::class, 'destroy']);
    Route::post('/prices/add', [PricesV1::class, 'add']);
    Route::put('/prices/update/{id}', [PricesV1::class, 'update']);

    Route::prefix('/uploadImage')->group(function () {
        Route::get('/', [UploadImageV1::class, 'get']);
        Route::get('/{id}', [UploadImageV1::class, 'getById']);
        Route::post('/', [UploadImageV1::class, 'store']);
        Route::put('/{id}', [UploadImageV1::class, 'update']);
        Route::delete('/{id}', [UploadImageV1::class, 'destroy']);
    });

    Route::prefix('/room')->group(function () {
        Route::get('/', [RoomV1::class, 'get']);
        Route::get('/{id}', [RoomV1::class, 'getById']);
        Route::post('/', [RoomV1::class, 'store']);
        Route::put('/{id}', [RoomV1::class, 'update']);
        Route::delete('/{id}', [RoomV1::class, 'destroy']);
    });

    Route::prefix('/order')->group(function () {
        Route::get('/', [OrderV1::class, 'get']);
        Route::get('/{id}', [OrderV1::class, 'getById']);
        Route::post('/', [OrderV1::class, 'store']);
        Route::put('/{id}', [OrderV1::class, 'update']);
        Route::delete('/{id}', [OrderV1::class, 'destroy']);
    });

    Route::prefix('/booking')->group(function () {
        Route::get('/test', [BookingV1::class, 'getWithDetails']);
        Route::get('/', [BookingV1::class, 'get']);
        Route::get('/{id}', [BookingV1::class, 'getById']);
        Route::post('/', [BookingV1::class, 'store']);
        Route::put('/{id}', [BookingV1::class, 'update']);
        Route::delete('/{id}', [BookingV1::class, 'destroy']);

    });

    Route::get('/search/byName/{name}', [SearchV1::class, 'search']);
    //  Route::get('/search', [SearchV1::class, 'searchAll']);
    Route::get('/search', [SearchV1::class, 'searchAll']);
});

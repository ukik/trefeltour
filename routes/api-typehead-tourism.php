<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Str;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoAuthenticate;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;
use Uasoft\Badaso\Middleware\BadasoCheckPermissionsForCRUD;

use \App\Http\Middleware\BadasoCheckPermissions as RootBadasoCheckPermissions;
use \App\Http\Middleware\BadasoCheckPermissionsForCRUD as RootBadasoCheckPermissionsForCRUD;
use \App\Http\Middleware\BadasoAuthenticate as RootBadasoAuthenticate;

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

Route::group(['prefix' => '/typehead/tourism', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers'], function ($request) {
    Route::get('/user', 'TourismTypeHeadController@getUser');
    Route::get('/user-booking-edit', 'TourismTypeHeadController@getUserBookingEdit');
    Route::get('/user-payment-validation-edit', 'TourismTypeHeadController@getUserPaymentValidationEdit');

    Route::get('/tourism_venues', 'TourismTypeHeadController@tourism_venues');
    Route::get('/tourism_bookings', 'TourismTypeHeadController@tourism_bookings');

    // tourism-bookings
    // Route::get('/tourism-bookings', 'TourismTypeHeadController@tourism_bookings');
    // Route::get('/tourism-drivers', 'TourismTypeHeadController@tourism_drivers');
    // Route::get('/tourism-maintenances', 'TourismTypeHeadController@tourism_maintenances');
    // Route::get('/tourism-payments', 'TourismTypeHeadController@tourism_payments');
    // Route::get('/tourism-payments-validations', 'TourismTypeHeadController@tourism_payments_validations');
    // Route::get('/tourism-rentals', 'TourismTypeHeadController@tourism_rentals');
    // Route::get('/tourism-returns', 'TourismTypeHeadController@tourism_returns');
    // Route::get('/tourism-vehicles', 'TourismTypeHeadController@tourism_vehicles');
    // Route::get('/tourism-workshops', 'TourismTypeHeadController@tourism_workshops');

});


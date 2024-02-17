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

    Route::get('/dialog_venue_tourism_venues', 'TourismTypeHeadController@dialog_venue_tourism_venues');
    Route::get('/dialog_venue_tourism_services', 'TourismTypeHeadController@dialog_venue_tourism_services');
    Route::get('/dialog_venue_tourism_prices', 'TourismTypeHeadController@dialog_venue_tourism_prices');
    Route::get('/dialog_venue_tourism_facilities', 'TourismTypeHeadController@dialog_venue_tourism_facilities');

    Route::get('/dialog_venue_tourism_bookings', 'TourismTypeHeadController@dialog_venue_tourism_bookings');
    Route::get('/dialog_booking_tourism_bookings', 'TourismTypeHeadController@dialog_booking_tourism_bookings');
    Route::get('/dialog_booking_tourism_payments_validations', 'TourismTypeHeadController@dialog_booking_tourism_payments_validations');

    Route::get('/tourism_bookings', 'TourismTypeHeadController@tourism_bookings');

});


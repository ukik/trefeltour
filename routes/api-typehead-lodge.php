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

Route::group(['prefix' => '/typehead/lodge', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers\TypeHeads'], function ($request) {
    Route::get('/user', 'LodgeTypeHeadController@getUser');
    Route::get('/add_to_cart_user', 'LodgeTypeHeadController@getUser');
    Route::post('/get_prices_booking', 'LodgeTypeHeadController@get_prices_booking');
    Route::post('/update_to_cart', 'LodgeTypeHeadController@update_to_cart');
    Route::post('/add_to_cart', 'LodgeTypeHeadController@add_to_cart');


    // Route::get('/user', 'SouvenirTypeHeadController@getUser');
    // Route::get('/add_to_cart_user', 'SouvenirTypeHeadController@getUser');
    // Route::post('/get_prices_booking', 'SouvenirTypeHeadController@get_prices_booking');
    // Route::post('/update_to_cart', 'SouvenirTypeHeadController@update_to_cart');
    // Route::post('/add_to_cart', 'SouvenirTypeHeadController@add_to_cart');

    Route::get('/dialog_room_lodge_profiles', 'LodgeTypeHeadController@dialog_room_lodge_profiles');
    Route::get('/dialog_staff_lodge_profiles', 'LodgeTypeHeadController@dialog_staff_lodge_profiles');
    Route::get('/dialog_facility_lodge_profiles', 'LodgeTypeHeadController@dialog_facility_lodge_profiles');
    Route::get('/dialog_prices_lodge_rooms', 'LodgeTypeHeadController@dialog_prices_lodge_rooms');
    // Route::get('/dialog_booking_souvenir_bookings', 'SouvenirTypeHeadController@dialog_booking_souvenir_bookings');

    // Route::get('/dialog_booking_souvenir_payments_validations', 'SouvenirTypeHeadController@dialog_booking_souvenir_payments_validations');


});


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

Route::group(['prefix' => '/typehead/souvenir', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers\TypeHeads'], function ($request) {
    Route::get('/user', 'SouvenirTypeHeadController@getUser');
    Route::get('/add_to_cart_user', 'SouvenirTypeHeadController@getUser');

    Route::post('/add_to_cart', 'SouvenirTypeHeadController@add_to_cart');
    Route::get('/dialog_product_souvenir_stores', 'SouvenirTypeHeadController@dialog_product_souvenir_stores');
    Route::get('/dialog_prices_souvenir_products', 'SouvenirTypeHeadController@dialog_prices_souvenir_products');





    Route::get('/user', 'TalentTypeHeadController@getUser');
    Route::get('/user-booking-edit', 'TalentTypeHeadController@getUserBookingEdit');
    Route::get('/user-payment-validation-edit', 'TalentTypeHeadController@getUserPaymentValidationEdit');


    Route::get('/dialog_booking_talent_bookings', 'TalentTypeHeadController@dialog_booking_talent_bookings');
    Route::get('/dialog_booking_talent_payments_validations', 'TalentTypeHeadController@dialog_booking_talent_payments_validations');

});


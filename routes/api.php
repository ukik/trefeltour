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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// use Illuminate\Support\Str;
// use Uasoft\Badaso\Facades\Badaso;
// use Uasoft\Badaso\Middleware\ApiRequest;
// use Uasoft\Badaso\Middleware\BadasoAuthenticate;
// use Uasoft\Badaso\Middleware\BadasoCheckPermissions;
// use Uasoft\Badaso\Middleware\BadasoCheckPermissionsForCRUD;

// $api_route_prefix = \config('badaso.api_route_prefix');
// dd(request('slug'));
// Route::group(['prefix' => $api_route_prefix, 'namespace' => 'App\Http\Controllers', 'as' => 'badaso.', 'middleware' => [ApiRequest::class]], function () {
//     Route::group(['prefix' => 'v1'], function () {
//         Route::group(['prefix' => 'restaurant'], function () {
//             Route::get('/', '\Campus\CampusBookingController@browse')->middleware(BadasoAuthenticate::class);
//         });
//     });
// });


// Route::group(['prefix' => ''], function ($request) {
//     // dd(request('slug'));
//     Route::get('/trevolia-api/v1/table/relation-data-by-slug', function () {
//         return 111;
//         //return view('welcome');
//     });

//     // switch ($request('slug')) {
//     //     case 'campus-bookings':
//     //         Illuminate\Support\Facades\

//     //         // Route::get('/relation-data-by-slug', 'BadasoTableController@getRelationDataBySlug')
//     //         break;

//     //     default:
//     //         # code...
//     //         break;
//     // }
//     // Route::get('/data-type', 'BadasoTableController@getDataType')->middleware(BadasoAuthenticate::class);
//     // Route::get('/', 'BadasoTableController@browse')->middleware(BadasoAuthenticate::class);
//     // Route::get('/read', 'BadasoTableController@read')->middleware(BadasoAuthenticate::class);
//     // Route::get('/data', 'BadasoTableController@getDataByTable')->middleware(BadasoAuthenticate::class);
//     // Route::get('/generate-crud', 'BadasoTableController@generateCRUD')->middleware(BadasoAuthenticate::class);
//     // Route::get('/relation-data-by-slug', 'BadasoTableController@getRelationDataBySlug')->middleware(BadasoAuthenticate::class);
// });

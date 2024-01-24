<?php

use Uasoft\Badaso\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;

if (!function_exists('Faker')) {
    function Faker(){
        return \Faker\Factory::create();
    }
}

if (!function_exists('Uuid')) {
    function Uuid(){
        return Faker()->uuid;
    }
}

if (!function_exists('CodeUuid')) {
    function CodeUuid($slug){
        $arr_slug = explode("-",$slug);
        $arr = explode("-",Faker()->uuid);
        return ucfirst($arr_slug[0]).'-'.ucfirst(substr($arr_slug[count($arr_slug)-1], 0, 5)).'-'.sprintf("%04s", rand(0,1000)).'-'.$arr[count($arr)-1];
    }
}

if (!function_exists('ShortUuid')) {
    function ShortUuid(){
        $arr = explode("-", uuid());
        return sprintf("%04s", rand(0,1000)).'-'.$arr[count($arr)-1];
    }
}

if (!function_exists('userId')) {
    function userId(){
        return Auth::user()->id;
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'administrator':
                        return true;
                        break;
                    default:
                        return false;
                        break;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin':
                        return true;
                        break;
                    default:
                        return false;
                        break;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}

if (!function_exists('isOnlyAdmin')) {
    function isOnlyAdmin(){
        if(!isAdmin() && !isSuperAdmin()) return ApiResponse::failed('Maaf harus dari admin');
    }
}


// if (!function_exists('make_uuid')) {
//     function make_uuid($label = 'CONPAS', $user_id = ''){
//         return $label.'-'.$user_id.'-'.prepand_zero(rand(0,100000), 5).'-'.uuid();
//     }
// }

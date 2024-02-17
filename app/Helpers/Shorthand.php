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
        return strtoupper($arr[1].'-'.$arr[0]);
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
                    default:
                        return false;
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
                    case 'administrator':
                    case 'admin':
                        return true;
                    default:
                        return false;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}

if (!function_exists('isAdminTransport')) {
    function isAdminTransport(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-transport':
                        return true;
                    default:
                        return false;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}
if (!function_exists('isAdminTalent')) {
    function isAdminTalent(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-talent':
                        return true;
                    default:
                        return false;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}
if (!function_exists('isAdminTourism')) {
    function isAdminTourism(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-tourism':
                        return true;
                    default:
                        return false;
                }
            }

        } else {
            return ApiResponse::unauthorized();
        }
    }
}
if (!function_exists('isOnlyAdminTransport')) {
    function isOnlyAdminTransport(){
        if(!isAdminTransport()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdminTalent')) {
    function isOnlyAdminTalent(){
        if(!isAdminTalent()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdminTourism')) {
    function isOnlyAdminTourism(){
        if(!isAdminTourism()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdmin')) {
    function isOnlyAdmin(){
        if(!isAdmin()) return ApiResponse::failed('Maaf harus dari admin');
    }
}


// if (!function_exists('make_uuid')) {
//     function make_uuid($label = 'CONPAS', $user_id = ''){
//         return $label.'-'.$user_id.'-'.prepand_zero(rand(0,100000), 5).'-'.uuid();
//     }
// }

if (!function_exists('SqlWithBinding')) {
    function SqlWithBinding($sql, $bindDataArr)
    {
        foreach ($bindDataArr as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }

    # $data = Model::first();
    # usage example: SqlWithBinding($data->toSql(), $data->getBindings());
    # You can not ->paginate() or ->toSql() after Post::all() / Post::get()
}

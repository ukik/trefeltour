<?php

use Uasoft\Badaso\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Uasoft\Badaso\Facades\Badaso;

if (!function_exists('getSlug')) {
    function getSlug($request){
        // dd(request()->slug);
        // if(request()->slug) {
        //     return request()->slug;
        // }
        $slug = explode('.', $request->route()->getName())[0];

        return $slug;
    }
}

if (!function_exists('getDataType')) {
    function getDataType($slug){
        $data_type = Badaso::model('DataType')::where('slug', $slug)->first();
        // $data_type = DataType::where('slug', $slug)->first();
        $data_type->data_rows = $data_type->dataRows;

        return $data_type;
    }
}

if (!function_exists('getUserId')) {
    function getUserId($user_id){
        return BadasoUsers::where('id', $user_id)->value('id');
    }
}

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
if (!function_exists('isAdminTravel')) {
    function isAdminTravel(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-travel':
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
if (!function_exists('isAdminSouvenir')) {
    function isAdminSouvenir(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-souvenir':
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
if (!function_exists('isAdminLodge')) {
    function isAdminLodge(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-lodge':
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

if (!function_exists('isAdminCulinary')) {
    function isAdminCulinary(){
        if(Auth::check()) {

            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'admin-culinary':
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




function getRoleFilter($label) {
    if(Auth::check()) {
        foreach (Auth::user()->roles as $value) {
            return ($value->name == $label) ? true : false;
        }
    } else {
        return ApiResponse::unauthorized();
    }
}


if (!function_exists('isTopCeo')) {
    function isTopCeo(){
        return getRoleFilter('top_ceo');
    }
}
if (!function_exists('isTopCfo')) {
    function isTopCfo(){
        return getRoleFilter('top_cfo');
    }
}
if (!function_exists('isTopCmo')) {
    function isTopCmo(){
        return getRoleFilter('top_cmo');
    }
}
if (!function_exists('isClientCompany')) {
    function isClientCompany(){
        return getRoleFilter('client_company');
    }
}
if (!function_exists('isClientRetail')) {
    function isClientRetail(){
        return getRoleFilter('client_retail');
    }
}
if (!function_exists('isClientAffiliate')) {
    function isClientAffiliate(){
        return getRoleFilter('client_affiliate');
    }
}
if (!function_exists('isStaffAdmin')) {
    function isStaffAdmin(){
        return getRoleFilter('staff_admin');
    }
}
if (!function_exists('isStaffFinance')) {
    function isStaffFinance(){
        return getRoleFilter('staff_finance');
    }
}
if (!function_exists('isStaffSupervisor')) {
    function isStaffSupervisor(){
        return getRoleFilter('staff_supervisor');
    }
}
if (!function_exists('isStaffEvent')) {
    function isStaffEvent(){
        return getRoleFilter('staff_event');
    }
}


if (!function_exists('isAddOrUpdateToCart')) {
    function isAddOrUpdateToCart(){
        if(Auth::check()) {
            foreach (Auth::user()->roles as $key => $value) {
                switch ($value->name) {
                    case 'client_affiliate':
                    case 'client_retail':
                    case 'client_company':
                    case 'staff_admin':
                        return true;
                    default:
                        return ApiResponse::failed('Maaf akses terbatas');
                }
            }
        } else {
            return ApiResponse::unauthorized();
        }
    }
}








if (!function_exists('isRoleName')) {
    function isRoleName(){
        if(Auth::check()) {
            foreach (Auth::user()->roles as $key => $value) {
                return $value->name;
            }
        } else {
            return ApiResponse::unauthorized();
        }
    }
}
























if (!function_exists('isOnlyAdminTravel')) {
    function isOnlyAdminTravel(){
        if(!isAdminTravel()) return ApiResponse::failed('Maaf harus dari admin');
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

if (!function_exists('isOnlyAdminSouvenir')) {
    function isOnlyAdminSouvenir(){
        if(!isAdminSouvenir()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdminTourism')) {
    function isOnlyAdminTourism(){
        if(!isAdminTourism()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdminLodge')) {
    function isOnlyAdminLodge(){
        if(!isAdminLodge()) return ApiResponse::failed('Maaf harus dari admin');
    }
}

if (!function_exists('isOnlyAdminCulinary')) {
    function isOnlyAdminCulinary(){
        if(!isAdminCulinary()) return ApiResponse::failed('Maaf harus dari admin');
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

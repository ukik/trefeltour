<?php

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
        $arr = explode("-",Faker()->uuid);
        return sprintf("%04s", rand(0,1000)).'-'.$arr[count($arr)-1];
    }
}

// if (!function_exists('make_uuid')) {
//     function make_uuid($label = 'CONPAS', $user_id = ''){
//         return $label.'-'.$user_id.'-'.prepand_zero(rand(0,100000), 5).'-'.uuid();
//     }
// }

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Badaso\Controller;
use BadasoUsers;
// use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationController extends Controller
{

    public $isLogged;
    public $isRole;

    public function __construct() {

        if(Auth::check()) {

            $this->isLogged = true;

            foreach (Auth::user()->roles as $key => $value) {
                $role = $value->name;
            }

            $this->isRole = $role;

        } else {
            return ApiResponse::unauthorized();
        }
    }

    public function arrayToPaginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    // public function browse(Request $request)
    // {
    //     try {
    //         return $user = BadasoUsers::has('notifications')->notifications()->paginate();

    //         $data = $this->paginate($user, $perPage = request()->perPage ?: 5, $page = request()->page ?: 1, $options = []);

    //         return ApiResponse::onlyEntity($data);
    //     } catch (Exception $e) {
    //         return ApiResponse::failed($e);
    //     }
    // }

    public function markasread($id) {

        try {
            BadasoUsers::first()
            ->unreadNotifications
            ->when($id, function($q) use ($id) {
                return $q->where('id',$id);
            })
            ->markAsRead();

            // $data = BadasoUsers::has('notifications')->first()->unreadNotifications()->paginate();

            // $encode = json_encode($data);
            // $data = json_decode($encode);

            // $data->nextPage = str_replace('=','',strstr($data->next_page_url, '='));
            // $data->prevPage = str_replace('=','',strstr($data->prev_page_url, '='));

            return ApiResponse::onlyEntity('Tandai Dibaca');
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function unread(Request $request)
    {
        try {
            // $data = BadasoUsers::has('notifications')->first()->notifications()->paginate(); // semua notifikasi
            $data = BadasoUsers::has('notifications')->first()->unreadNotifications()->paginate(); // hanya notifikasi belum terbaca
            // $user = BadasoUsers::has('notifications')->first()->unreadNotifications;

            $encode = json_encode($data);
            $data = json_decode($encode);

            $data->nextPage = str_replace('=','',strstr($data->next_page_url, '='));
            $data->prevPage = str_replace('=','',strstr($data->prev_page_url, '='));

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function all(Request $request)
    {
        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $builder_params = [
                'order_field' => isset($request['order_field']) ? $request['order_field'] : $data_type->order_column,
                'order_direction' => isset($request['order_direction']) ? $request['order_direction'] : $data_type->order_direction,
            ];

            if ($data_type->model_name) {
                $records = GetData::clientSideWithModel($data_type, $builder_params);
            } else {
                $records = GetData::clientSideWithQueryBuilder($data_type, $builder_params);
            }

            return ApiResponse::onlyEntity($records);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

}

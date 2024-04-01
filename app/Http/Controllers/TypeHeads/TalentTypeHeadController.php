<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TalentBookings;
use TalentCarts;
use TalentPrices;

use TalentPaymentsValidations;
use TalentProfiles;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class TalentTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        return TalentProfiles::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];

        $temp = TalentProfiles::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }





    // function dialog_profile_talent_profilesX() {
    //     $profile_id = \TalentSkills::where('id',request()->id)->value('profile_id');
    //     $data = \TalentProfiles::where('id',$profile_id)->with([
    //         'badasoUsers',
    //         'badasoUser',
    //     ])->first();
    //     return ApiResponse::onlyEntity($data);
    // }

    // function dialog_profile_talent_skillsX() {
    //     $skill_id = \TalentPrices::where('id',request()->id)->value('skill_id');
    //     $data = \TalentSkills::where('id',$skill_id)->with([
    //         'talentProfile',
    //         'talentProfiles',
    //         'talentProfile.badasoUser',
    //         'talentPrice',
    //         'talentPrices',
    //     ])->first();
    //     return ApiResponse::onlyEntity($data);
    // }






    function dialog_skill_talent_profiles() {
        $data = \TalentSkills::where('id',request()->id)
            ->with('talentProfile.badasoUsers')
            ->first();
        $data = $data->talentProfile;
        return ApiResponse::onlyEntity($data);
    }

    function dialog_prices_talent_skills() {
        $data = \TalentPrices::where('id',request()->id)
            ->with([
                'talentSkill.talentProfiles',
            ])
            ->first();
        $data = $data->talentSkill;
        return ApiResponse::onlyEntity($data);
    }




    function dialog_cart_price(Request $request) {
        // return request();
        $data = \TalentPrices::with([
            'talentSkills',
            'talentProfiles',
            'talentProfile',
            'talentSkill',
            'talentSkills',
        ])->where('id', request()->price_id)->first();
        return ApiResponse::onlyEntity($data);
    }


    function get_prices_booking(Request $request) {
        // return request();
        $payload = json_decode(request()->payload, true);
        $data = \TalentCarts::with([
            'badasoUsers',
            'badasoUser',

            'talentSkill',
            'talentSkills',
            'talentPrice',
            'talentPrices',
            'talentProfile',
            'talentProfiles',
        ])->whereIn('id', $payload)->get();
        return ApiResponse::onlyEntity($data);
    }


    function add_to_cart(Request $request) {


        if(!request()->customer_id) return ApiResponse::failed("Customer wajib diisi");

        $data = TalentPrices::where('id', request()->price_id)->first();

        $quantity = request()->quantity;

        $carts = TalentCarts::query()
            ->where('customer_id', request()->customer_id)
            ->where('price_id', request()->price_id)
            ->first();

        TalentCarts::updateOrCreate([
                'customer_id' => request()->customer_id,
                'profile_id' => $data->profile_id,
                'skill_id' => $data->skill_id,
                'price_id' => $data->id,
            ],
            [
                'customer_id' => request()->customer_id,
                'profile_id' => $data->profile_id,
                'skill_id' => $data->skill_id,
                'price_id' => $data->id,
                'quantity' => !$carts?->quantity ? $quantity : DB::raw("quantity + $quantity"), //DB::raw("quantity + $quantity"),
                'code_table' => "talent-carts",
                'uuid' => $carts?->uuid ?: ShortUuid(),
            ]
        );

        // return request();
    }

    function update_to_cart(Request $request) {
        // return request();
        if(!request()->quantity) return ApiResponse::failed("Customer wajib diisi");

        TalentCarts::where('id', request()->id)->update([
                'quantity' => request()->quantity,
        ]);

        $data = \TalentCarts::with([
            'badasoUsers',
            'badasoUser',

            'talentSkill',
            'talentSkills',
            'talentPrice',
            'talentPrices',
            'talentProfiles',
        ])->orderBy('id','desc');
        if(request()['showSoftDelete'] == 'true') {
            $data = $data->onlyTrashed();
        }

        if(request()->popup) {
            $data = $data->where('id', request()->id)->paginate(request()->perPage);
        } else {
            $data = $data->paginate(request()->perPage);
        }

        // $encode = json_encode($paginate);
        // $decode = json_decode($encode);
        // $data['data'] = $decode->data;
        // $data['total'] = $decode->total;

        return ApiResponse::onlyEntity($data);
    }








    function dialog_booking_talent_bookings() {

        $data = \TalentBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'talentBookings',
            'talentBooking',
            'talentProfile',
            'talentProfiles',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_talent_payments_validations() {

        // $payment_id = \TalentPaymentsValidations::where('id',request()->id)->value('payment_id');
        // $data = \TalentBookingsCheckPayments::where('payment_id',$payment_id)->with([
        //     'badasoUsers',
        //     'talentBookings',
        //     'talentBooking',
        //     'talentPrice',
        //     'talentPrices',
        //     'talentSkill',
        //     'talentSkills',
        // ])->first();

        $data = TalentPaymentsValidations::where('id',request()->id)->with([
            'talentPayment',
            'talentPayment.badasoUsers',
            'talentPayment.talentBookings',
        ])->first();
        $data = $data->talentPayment;
        return ApiResponse::onlyEntity($data);
    }


}

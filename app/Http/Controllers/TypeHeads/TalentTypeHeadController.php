<?php

namespace App\Http\Controllers\TypeHeads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TalentBookings;

use TalentPaymentsValidations;
use TalentProfiles;
use Uasoft\Badaso\Helpers\ApiResponse;

class TalentTypeHeadController extends Controller
{
    function getUser() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $temp = TalentProfiles::where('id', request()->id)->value('user_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserBookingEdit() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $temp = TalentBookings::where('id', request()->id)->value('customer_id');
        return BadasoUsers::where('id', $temp)->first();
    }

    function getUserPaymentValidationEdit() {
        if(isAdminTalent()) {
            return Auth::user();
        }

        $validator_id = TalentPaymentsValidations::where('id', request()->id)->value('validator_id');
        return BadasoUsers::where('id', $validator_id)->first();
    }

    function dialog_profile_talent_profiles() {
        $profile_id = \TalentSkills::where('id',request()->id)->value('profile_id');
        $data = \TalentProfiles::where('id',$profile_id)->with([
            'badasoUsers',
            'badasoUser',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_profile_talent_skills() {
        $skill_id = \TalentPrices::where('id',request()->id)->value('skill_id');
        $data = \TalentSkills::where('id',$skill_id)->with([
            'talentProfile',
            'talentProfiles',
            'talentProfile.badasoUser',
            'talentPrice',
            'talentPrices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_talent_bookings() {

        $data = \TalentBookingsCheckPayments::where('payment_id',request()->id)->with([
            'badasoUsers',
            'talentBookings',
            'talentBooking',
            'talentPrice',
            'talentPrices',
            'talentSkill',
            'talentSkills',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_talent_payments_validations() {

        $payment_id = \TalentPaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = \TalentBookingsCheckPayments::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'talentBookings',
            'talentBooking',
            'talentPrice',
            'talentPrices',
            'talentSkill',
            'talentSkills',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }


}

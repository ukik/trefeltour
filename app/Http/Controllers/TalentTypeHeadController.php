<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use TalentBookings;
use TalentPayments;
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
            'talentProfile',
            'talentProfile.badasoUser',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }








    function dialog_venue_tourism_bookings() {
        $venue_id = \TourismBookings::where('id',request()->id)->value('venue_id');
        $data = \TourismVenues::where('id',$venue_id)->with([
            'badasoUsers',
            // 'tourismPrice',
            'tourismPrices',
            'tourismFacility',
            'tourismFacilities',
            'tourismService',
            'tourismServices',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_tourism_bookings() {

        $data = \TourismBookingsCheckPayements::where('payment_id',request()->id)->with([
            'badasoUsers',
            'tourismBookings',
            'tourismBooking',
            'tourismVenue',
            'tourismVenues',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }

    function dialog_booking_tourism_payments_validations() {

        $payment_id = \TourismPaymentsValidations::where('id',request()->id)->value('payment_id');
        $data = \TourismBookingsCheckPayements::where('payment_id',$payment_id)->with([
            'badasoUsers',
            'tourismBookings',
            'tourismBooking',
            'tourismVenue',
            'tourismVenues',
        ])->first();
        return ApiResponse::onlyEntity($data);
    }



    function tourism_bookings() {

        if(request()->id && !request()['keyword'] && !request()['label']) {
            $data = \TourismBookingsCheckPayements::where('id',request()->id)->with([
                'badasoUsers',
                'tourismBookings',
                'tourismBooking',
                'tourismVenue',
                'tourismVenues',
            ])->first();
            return ApiResponse::onlyEntity($data);
        }
    }

}

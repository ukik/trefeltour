<?php

namespace App\Listeners;

use App\Notifications\NotifyClientToAdminNotification;
use Illuminate\Support\Facades\Notification;
use BadasoUsers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// 1	administrator
// 2	customer
// 3	admin_rental_transportasi
// 4	student
// 5	client_company
// 6	staff_admin
// 7	staff_finance
// 8	staff_supervisor
// 9	staff_event
// 10	top_ceo
// 11	top_cfo
// 12	top_cmo
// 13	client_retail
// 14	client_affiliate


class CreateNotifyClientToAdminNotification
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $user = BadasoUsers::whereHase('userRoles', function($q){
            $q->whereIn('role_id',[6,7,8,9,10,11,12]);
        })->get();

        // NotifyToAdmin(new NotifyClientToAdminNotification(Auth::user(), 'travel', 'travel-bookings', $payload));
    }
}

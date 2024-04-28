<?php

namespace App\Http\Controllers;

use CulinaryBookings;
use CulinaryBookingsItems;
use CulinaryCarts;
use CulinaryPayments;
use CulinaryPaymentsValidations;
use CulinaryPrices;
use CulinaryProducts;
use CulinaryStores;
use Exception;
use LodgeBookings;
use LodgeBookingsItems;
use LodgeCarts;
use LodgeFacility;
use LodgePayments;
use LodgePaymentsValidations;
use LodgePrices;
use LodgeProfiles;
use LodgeRooms;
use LodgeStaffs;
use SouvenirBookings;
use SouvenirBookingsItems;
use SouvenirCarts;
use SouvenirPayments;
use SouvenirPaymentsValidations;
use SouvenirPrices;
use SouvenirProducts;
use SouvenirStores;
use TalentBookings;
use TalentBookingsItems;
use TalentCarts;
use TalentPayments;
use TalentPaymentsValidations;
use TalentPrices;
use TalentProfiles;
use TalentSkills;
use TourismBookings;
use TourismBookingsItems;
use TourismCarts;
use TourismFacilities;
use TourismPayments;
use TourismPaymentsValidations;
use TourismPrices;
use TourismServices;
use TourismVenues;
use TransportBookings;
use TransportBookingsItems;
use TransportCarts;
use TransportPayments;
use TransportPaymentsValidations;
use TransportPrices;
use TravelBookings;
use TravelBookingsItems;
use TravelCarts;
use TravelPayments;
use TravelPaymentsValidations;
use TravelPrices;
use TravelReservations;
use TravelStores;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\AuthenticatedUser;
use Uasoft\Badaso\Interfaces\WidgetInterface;

class BadasoDashboardController extends Controller
{
    public function index()
    {

        try {
            $widgets = config('badaso.widgets');
            $data = [];
            foreach ($widgets as $widget) {
                $widget_class = new $widget();
                if ($widget_class instanceof WidgetInterface) {
                    $permissions = $widget_class->getPermissions();
                    if (is_null($permissions)) {
                        $widget_data = $widget_class->run();
                        $data[] = $widget_data;
                    } else {
                        $allowed = AuthenticatedUser::isAllowedTo($permissions);
                        if ($allowed) {
                            $widget_data = $widget_class->run();
                            $data[] = $widget_data;
                        }
                    }
                }
            }

            // $data[] = [
            //     "label" => "Atur Tanggal",
            //     "icon" => 'event_available',
            //     "value" => 'xxxxx',
            //     "prefixValue" => "",
            //     "delimiter" => "",
            // ];

            return ApiResponse::success(collect($data)->toArray());

            // {
            // "label": "User",
            // "icon": "person",
            // "value": 4,
            // "prefixValue": "",
            // "delimiter": "."
            // },
            $egp_auto = \DB::table('sw_setup_egps_auto_sums')->value('sum_total');
            $egp_custom_ekor = \DB::table('sw_setup_egps')->value('ekor');
            $sw_setup_dates = \DB::table('sw_setup_dates')->first();
            $sw_setup_basic_products_count = \DB::table('sw_setup_basic_products_count')->value('count');
            $sw_setup_raw_materials_count = \DB::table('sw_setup_raw_materials_count')->value('count');
            $sw_items_count = \DB::table('sw_items_count')->value('count');

            $data[] = [
                "label" => "Atur Tanggal",
                "icon" => 'event_available',
                "value" => ucfirst($sw_setup_dates->selected_day).', '.$sw_setup_dates->selected_date,
                "prefixValue" => "",
                "delimiter" => "",
            ];
            $data[] = [
                "label" => "Produk Dasar",
                "icon" => 'fastfood',
                "value" => $sw_setup_basic_products_count.' item',
                "prefixValue" => "",
                "delimiter" => "",
            ];
            $data[] = [
                "label" => "Bahan Baku",
                "icon" => 'lunch_dining',
                "value" => $sw_setup_raw_materials_count.' item',
                "prefixValue" => "",
                "delimiter" => "",
            ];
            $data[] = [
                "label" => "Daftar Item",
                "icon" => 'restaurant',
                "value" => $sw_items_count.' item',
                "prefixValue" => "",
                "delimiter" => "",
            ];

            if(roleName() !== 'mitra') {
                $data[] = [
                    "label" => "EGP Auto",
                    "icon" => 'shopping_basket',
                    "value" => rupiah($egp_auto),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
                $data[] = [
                    "label" => "EGP Custom",
                    "icon" => 'account_balance_wallet',
                    "value" => rupiah($egp_custom_ekor * $egp_auto),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }


            return ApiResponse::success(collect($data)->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    private function getCount($model) {
        if(isClientOnly()) return $model->where('customer_id', authID())
            ->whereYear('created_at', '=', request()->year)
            ->whereMonth('created_at', '=', request()->month)
            ->count();
        return $model
            ->whereYear('created_at', '=', request()->year)
            ->whereMonth('created_at', '=', request()->month)
            ->count();
    }

    private function getCountValidation($model, $eager) {
        if(isClientOnly()) return $model->whereHas($eager, function($q) {
                return $q->where('customer_id', authID());
            })
            ->whereYear('created_at', '=', request()->year)
            ->whereMonth('created_at', '=', request()->month)
            ->count();
        return $model
            ->whereYear('created_at', '=', request()->year)
            ->whereMonth('created_at', '=', request()->month)
            ->count();
    }

    public function year() {
        try {
            $data = \DB::table('years')->select('year')->pluck('year');

            return ApiResponse::success(collect($data)->toArray());
        } catch (Exception $e) {
            return [];
            return ApiResponse::failed($e);
        }
    }

    public function count_travel()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Travel Vendor",
                    "icon" => 'storefront',
                    "value" => $this->getCount(TravelStores::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Travel Reservasi",
                    "icon" => 'confirmation_number',
                    "value" => $this->getCount(TravelReservations::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Travel Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(TravelPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Travel Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(TravelCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Travel Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(TravelBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Travel Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(TravelBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Travel Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(TravelPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Travel Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(TravelPaymentsValidations::query(),'travelPayment') : $this->getCount(TravelPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_culinary()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Kuliner Toko",
                    "icon" => 'storefront',
                    "value" => $this->getCount(CulinaryStores::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Kuliner Menu",
                    "icon" => 'fastfood',
                    "value" => $this->getCount(CulinaryProducts::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Kuliner Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(CulinaryPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Kuliner Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(CulinaryCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Kuliner Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(CulinaryBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Kuliner Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(CulinaryBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Kuliner Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(CulinaryPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Kuliner Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" =>  isClientOnly() ? $this->getCountValidation(CulinaryPaymentsValidations::query(),'culinaryPayment') : $this->getCount(CulinaryPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_lodge()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Hotel Profile",
                    "icon" => 'storefront',
                    "value" => (LodgeProfiles::query()->where('user_id', authID())->count()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Hotel Staff",
                    "icon" => 'assignment_ind',
                    "value" => $this->getCount(LodgeStaffs::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Hotel Fasilitas",
                    "icon" => 'room_service',
                    "value" => $this->getCount(LodgeFacility::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Hotel Kamar",
                    "icon" => 'meeting_room',
                    "value" => $this->getCount(LodgeRooms::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Hotel Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(LodgePrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Hotel Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(LodgeCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Hotel Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(LodgeBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Hotel Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(LodgeBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Hotel Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(LodgePayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Hotel Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(LodgePaymentsValidations::query(),'lodgePayment') : $this->getCount(LodgePaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_transport()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Rental Vendor",
                    "icon" => 'storefront',
                    "value" => (LodgeProfiles::query()->where('user_id', authID())->count()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Rental Bengkel",
                    "icon" => 'store',
                    "value" => $this->getCount(LodgeStaffs::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Rental Supir",
                    "icon" => 'assignment_ind',
                    "value" => $this->getCount(LodgeFacility::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Rental Kendaraan",
                    "icon" => 'car_repair',
                    "value" => $this->getCount(LodgeRooms::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Rental Perawatan",
                    "icon" => 'build',
                    "value" => $this->getCount(LodgeRooms::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Rental Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(TransportPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Rental Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(TransportCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Rental Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(TransportBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Rental Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(TransportBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Rental Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(TransportPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Rental Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(TransportPaymentsValidations::query(),'transportPayment') : $this->getCount(TransportPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_tourism()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Wisata Vendor",
                    "icon" => 'storefront',
                    "value" => (TourismVenues::query()->where('user_id', authID())->count()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Rental Layanan",
                    "icon" => 'hot_tub',
                    "value" => $this->getCount(TourismServices::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Wisata Wahana",
                    "icon" => 'weekend',
                    "value" => $this->getCount(TourismFacilities::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Wisata Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(TourismPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Wisata Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(TourismCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Wisata Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(TourismBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Wisata Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(TourismBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Wisata Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(TourismPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Wisata Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(TourismPaymentsValidations::query(),'tourismPayment') : $this->getCount(TourismPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_talent()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Talent Profile",
                    "icon" => 'storefront',
                    "value" => (TalentProfiles::query()->where('user_id', authID())->count()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Talent Skill",
                    "icon" => 'emoji_events',
                    "value" => $this->getCount(TalentSkills::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Talent Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(TalentPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Talent Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(TalentCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Talent Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(TalentBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Talent Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(TalentBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Talent Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(TalentPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Talent Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(TalentPaymentsValidations::query(),'talentPayment') : $this->getCount(TalentPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function count_souvenir()
    {

        // try {
            $data = [];

            if(!isClientOnly()) {
                $data[] = [
                    "label" => "Souvenir Toko",
                    "icon" => 'storefront',
                    "value" => (SouvenirStores::query()->where('user_id', authID())->count()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];

                $data[] = [
                    "label" => "Souvenir Produk",
                    "icon" => 'inventory',
                    "value" => $this->getCount(SouvenirProducts::query()),
                    "prefixValue" => "",
                    "delimiter" => "",
                ];
            }

            $data[] = [
                "label" => "Souvenir Harga",
                "icon" => 'add_shopping_cart',
                "value" => $this->getCount(SouvenirPrices::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Souvenir Keranjang",
                "icon" => 'shopping_cart',
                "value" => $this->getCount(SouvenirCarts::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Souvenir Booking",
                "icon" => 'local_mall',
                "value" => $this->getCount(SouvenirBookings::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Souvenir Booking Item",
                "icon" => 'shopping_basket',
                "value" => $this->getCount(SouvenirBookingsItems::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Souvenir Pembayaran",
                "icon" => 'credit_card',
                "value" => $this->getCount(SouvenirPayments::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];

            $data[] = [
                "label" => "Souvenir Pembayaran Validasi",
                "icon" => 'card_membership',
                "value" => isClientOnly() ? $this->getCountValidation(SouvenirPaymentsValidations::query(),'souvenirPayment') : $this->getCount(SouvenirPaymentsValidations::query()),
                "prefixValue" => "",
                "delimiter" => "",
            ];


            return ApiResponse::success(collect($data)->toArray());
        // } catch (Exception $e) {
        //     return [];
        //     return ApiResponse::failed($e);
        // }
    }

    public function manifest()
    {
        $pwa_manifest = config('badaso.manifest');

        return response($pwa_manifest, 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}

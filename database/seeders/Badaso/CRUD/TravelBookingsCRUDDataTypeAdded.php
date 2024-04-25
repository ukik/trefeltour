<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class TravelBookingsCRUDDataTypeAdded extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        \DB::beginTransaction();

        try {

            $data_type = Badaso::model('DataType')->where('name', 'travel_bookings')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'travel_bookings')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 117,
                'name' => 'travel_bookings',
                'slug' => 'travel-bookings',
                'display_name_singular' => 'Travel Booking',
                'display_name_plural' => 'Travel Booking',
                'icon' => 'local_mall',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Travels\\TravelBookingsController',
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => NULL,
                'notification' => '[]',
                'is_soft_delete' => 1,
                'created_at' => '2024-04-02T23:21:22.000000Z',
                'updated_at' => '2024-04-25T09:45:23.000000Z',
            ));

            Badaso::model('Permission')->generateFor('travel_bookings');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/travel-bookings')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Travel Booking',
                    'target' => '_self',
                    'icon_class' => 'local_mall',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_travel_bookings',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/travel-bookings';
                $menu_item->title = 'Travel Booking';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'local_mall';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_travel_bookings';
                $menu_item->order = $order;
                $menu_item->save();
            }

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

           throw new Exception('Exception occur ' . $e);
        }
    }
}

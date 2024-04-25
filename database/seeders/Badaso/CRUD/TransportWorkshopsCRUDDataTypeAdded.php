<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class TransportWorkshopsCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'transport_workshops')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'transport_workshops')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 35,
                'name' => 'transport_workshops',
                'slug' => 'transport-workshops',
                'display_name_singular' => 'Rental Bengkel',
                'display_name_plural' => 'Rental Bengkel',
                'icon' => 'store',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Transports\\TransportWorkshopsController',
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
                'created_at' => '2024-01-30T15:02:35.000000Z',
                'updated_at' => '2024-04-25T13:05:00.000000Z',
            ));

            Badaso::model('Permission')->generateFor('transport_workshops');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/transport-workshops')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Rental Bengkel',
                    'target' => '_self',
                    'icon_class' => 'store',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_transport_workshops',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/transport-workshops';
                $menu_item->title = 'Rental Bengkel';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'store';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_transport_workshops';
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

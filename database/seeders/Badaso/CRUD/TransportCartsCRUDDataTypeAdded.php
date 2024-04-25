<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class TransportCartsCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'transport_carts')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'transport_carts')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 108,
                'name' => 'transport_carts',
                'slug' => 'transport-carts',
                'display_name_singular' => 'Rental Keranjang',
                'display_name_plural' => 'Rental Keranjang',
                'icon' => 'shopping_cart',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Transports\\TransportCartsController',
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
                'created_at' => '2024-03-25T17:34:12.000000Z',
                'updated_at' => '2024-04-25T08:06:51.000000Z',
            ));

            Badaso::model('Permission')->generateFor('transport_carts');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/transport-carts')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Rental Keranjang',
                    'target' => '_self',
                    'icon_class' => 'shopping_cart',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_transport_carts',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/transport-carts';
                $menu_item->title = 'Rental Keranjang';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'shopping_cart';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_transport_carts';
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

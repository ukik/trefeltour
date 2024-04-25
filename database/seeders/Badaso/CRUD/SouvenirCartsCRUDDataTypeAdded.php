<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class SouvenirCartsCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'souvenir_carts')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'souvenir_carts')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 72,
                'name' => 'souvenir_carts',
                'slug' => 'souvenir-carts',
                'display_name_singular' => 'Suvenir Keranjang',
                'display_name_plural' => 'Suvenir Keranjang',
                'icon' => 'shopping_cart',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Souvenirs\\SouvenirCartsController',
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => NULL,
                'notification' => '[]',
                'is_soft_delete' => false,
                'created_at' => '2024-02-22T13:25:11.000000Z',
                'updated_at' => '2024-04-25T08:32:48.000000Z',
            ));

            Badaso::model('Permission')->generateFor('souvenir_carts');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/souvenir-carts')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Suvenir Keranjang',
                    'target' => '_self',
                    'icon_class' => 'shopping_cart',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_souvenir_carts',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/souvenir-carts';
                $menu_item->title = 'Suvenir Keranjang';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'shopping_cart';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_souvenir_carts';
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

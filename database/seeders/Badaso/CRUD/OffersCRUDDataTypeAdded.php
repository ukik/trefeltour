<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class OffersCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'offers')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'offers')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 122,
                'name' => 'offers',
                'slug' => 'offers',
                'display_name_singular' => 'Data Penawaran',
                'display_name_plural' => 'Data Penawaran',
                'icon' => 'list_alt',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\OffersController',
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
                'created_at' => '2024-04-29T10:34:01.000000Z',
                'updated_at' => '2024-04-29T15:37:33.000000Z',
            ));

            Badaso::model('Permission')->generateFor('offers');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/offers')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Data Penawaran',
                    'target' => '_self',
                    'icon_class' => 'list_alt',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_offers',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/offers';
                $menu_item->title = 'Data Penawaran';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'list_alt';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_offers';
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

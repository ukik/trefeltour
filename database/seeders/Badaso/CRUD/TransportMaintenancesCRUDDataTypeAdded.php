<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class TransportMaintenancesCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'transport_maintenances')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'transport_maintenances')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'name' => 'transport_maintenances',
                'slug' => 'transport-maintenances',
                'display_name_singular' => 'Transport Perbaikan',
                'display_name_plural' => 'Transport Perbaikan',
                'icon' => NULL,
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Transports\\TransportMaintenancesController',
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'description' => NULL,
                'details' => NULL,
                'notification' => '[]',
                'is_soft_delete' => true,
                'updated_at' => '2024-01-31T01:56:52.000000Z',
                'created_at' => '2024-01-31T01:56:52.000000Z',
                'id' => 39,
            ));

            Badaso::model('Permission')->generateFor('transport_maintenances');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/transport-maintenances')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Transport Perbaikan',
                    'target' => '_self',
                    'icon_class' => '',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_transport_maintenances',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/transport-maintenances';
                $menu_item->title = 'Transport Perbaikan';
                $menu_item->target = '_self';
                $menu_item->icon_class = '';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_transport_maintenances';
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

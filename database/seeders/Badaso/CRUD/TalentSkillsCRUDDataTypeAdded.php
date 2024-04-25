<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class TalentSkillsCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'talent_skills')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'talent_skills')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 64,
                'name' => 'talent_skills',
                'slug' => 'talent-skills',
                'display_name_singular' => 'Talent Skill',
                'display_name_plural' => 'Talent Skill',
                'icon' => 'emoji_events',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Talents\\TalentSkillsController',
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
                'created_at' => '2024-02-17T11:34:05.000000Z',
                'updated_at' => '2024-04-25T09:30:12.000000Z',
            ));

            Badaso::model('Permission')->generateFor('talent_skills');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/talent-skills')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Talent Skill',
                    'target' => '_self',
                    'icon_class' => 'emoji_events',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_talent_skills',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/talent-skills';
                $menu_item->title = 'Talent Skill';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'emoji_events';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_talent_skills';
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

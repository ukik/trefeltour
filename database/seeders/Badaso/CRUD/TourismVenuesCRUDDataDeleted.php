<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class TourismVenuesCRUDDataDeleted extends Seeder
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
			$data_type = Badaso::model('DataType')->where('name', 'tourism_venues')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'tourism_venues')->delete();
            }

			Badaso::model('Permission')->removeFrom('tourism_venues');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/tourism-venues');

            if ($menuItem->exists()) {
                $menuItem->delete();
            }

			\DB::commit();
       	} catch(Exception $e) {
        	\DB::rollBack();

        	throw new Exception('Exception occur ' . $e);
       	}
    }
}

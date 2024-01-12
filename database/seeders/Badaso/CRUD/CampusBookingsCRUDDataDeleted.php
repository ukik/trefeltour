<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class CampusBookingsCRUDDataDeleted extends Seeder
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
			$data_type = Badaso::model('DataType')->where('name', 'campus_bookings')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'campus_bookings')->delete();
            }

			Badaso::model('Permission')->removeFrom('campus_bookings');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/campus-bookings');

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

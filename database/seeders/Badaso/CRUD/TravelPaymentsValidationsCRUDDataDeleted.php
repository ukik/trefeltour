<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class TravelPaymentsValidationsCRUDDataDeleted extends Seeder
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
			$data_type = Badaso::model('DataType')->where('name', 'travel_payments_validations')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'travel_payments_validations')->delete();
            }

			Badaso::model('Permission')->removeFrom('travel_payments_validations');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/travel-payments-validations');

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

<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class SouvenirPricesCRUDDataDeleted extends Seeder
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
			$data_type = Badaso::model('DataType')->where('name', 'souvenir_prices')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'souvenir_prices')->delete();
            }

			Badaso::model('Permission')->removeFrom('souvenir_prices');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/souvenir-prices');

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

<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class CinemaMoviesCRUDDataDeleted extends Seeder
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
			$data_type = Badaso::model('DataType')->where('name', 'cinema_movies')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'cinema_movies')->delete();
            }

			Badaso::model('Permission')->removeFrom('cinema_movies');

			$menuItem = Badaso::model('MenuItem')::where('url', '/general/cinema-movies');

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

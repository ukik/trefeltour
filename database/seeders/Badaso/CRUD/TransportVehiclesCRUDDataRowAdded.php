<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class TransportVehiclesCRUDDataRowAdded extends Seeder
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

            $data_type = Badaso::model('DataType')::where('name', 'transport_vehicles')->first();

            \DB::table('badaso_data_rows')->insert(array (
                0 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'id',
                    'type' => 'number',
                    'display_name' => 'No',
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 1,
                ),
                1 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'uuid',
                    'type' => 'text',
                    'display_name' => 'UUID',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 2,
                ),
                2 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'rental_id',
                    'type' => 'relation',
                    'display_name' => 'Vendor',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => '{"relation_type":"belongs_to","destination_table":"transport_rentals","destination_table_column":"id","destination_table_display_column":"name","destination_table_display_more_column":["id","name"]}',
                    'order' => 3,
                ),
                3 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'user_id',
                    'type' => 'relation',
                    'display_name' => 'Akun Pemilik Mobil',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => '{"relation_type":"belongs_to","destination_table":"badaso_users","destination_table_column":"id","destination_table_display_column":"username","destination_table_display_more_column":["id","username"]}',
                    'order' => 4,
                ),
                4 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'model',
                    'type' => 'text',
                    'display_name' => 'Model',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 5,
                ),
                5 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'brand',
                    'type' => 'text',
                    'display_name' => 'Brand',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 6,
                ),
                6 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'category',
                    'type' => 'select',
                    'display_name' => 'Kategori',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
"size": 12,
"items": [
{
"label": "mobil",
"value": "mobil"
},
{
"label": "motor",
"value": "motor"
},
{
"label": "bus",
"value": "bus"
},
{
"label": "truk",
"value": "truk"
},
{
"label": "pickup",
"value": "pickup"
},
{
"label": "lainnya",
"value": "others"
}
]
}',
                    'relation' => NULL,
                    'order' => 7,
                ),
                7 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'image',
                    'type' => 'upload_image_multiple',
                    'display_name' => 'Image',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 8,
                ),
                8 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'fuel_type',
                    'type' => 'select',
                    'display_name' => 'Bahan Bakar',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
"size": 12,
"items": [
{
"label": "bensin",
"value": "bensin"
},
{
"label": "solar",
"value": "solar"
},
{
"label": "listrik",
"value": "listrik"
},
{
"label": "hidrogen",
"value": "hidrogen"
},
{
"label": "lainnya",
"value": "others"
}
]
}',
                    'relation' => NULL,
                    'order' => 9,
                ),
                9 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'date_production',
                    'type' => 'text',
                    'display_name' => 'Tahun Produksi',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 10,
                ),
                10 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'color',
                    'type' => 'text',
                    'display_name' => 'Warna',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 11,
                ),
                11 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'code_stnk',
                    'type' => 'text',
                    'display_name' => 'Nomor Stnk',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 12,
                ),
                12 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'slot_passanger',
                    'type' => 'select',
                    'display_name' => 'Slot Penumpang',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
"size": 12,
"items": [
{
"label": "1",
"value": "1"
},
{
"label": "2",
"value": "2"
},
{
"label": "3",
"value": "3"
},
{
"label": "4",
"value": "4"
},
{
"label": "5",
"value": "5"
},
{
"label": "6",
"value": "6"
},
{
"label": "7",
"value": "7"
},
{
"label": "8",
"value": "8"
},
{
"label": "9",
"value": "9"
},
{
"label": "10",
"value": "10"
}        
]
}',
                    'relation' => NULL,
                    'order' => 13,
                ),
                13 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'is_available',
                    'type' => 'switch',
                    'display_name' => 'Available',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 14,
                ),
                14 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'code_table',
                    'type' => 'text',
                    'display_name' => 'Nama Tabel',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 15,
                ),
                15 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'created_at',
                    'type' => 'datetime',
                    'display_name' => 'Dibuat Pada',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 16,
                ),
                16 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'updated_at',
                    'type' => 'datetime',
                    'display_name' => 'Diubah Pada',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 17,
                ),
                17 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'deleted_at',
                    'type' => 'datetime',
                    'display_name' => 'Dihapus Pada',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 18,
                ),
            ));

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

            throw new Exception('exception occur ' . $e);
        }
    }
}


<?php

namespace App\Observers\Observer;

class CodeTableObserver
{
    // Retrieved. event ini dijalankan ketika model diambil dari database.
    // Creating. seperti namanya, Ya, event ini dijalankan saat pembuatan sebuah model dan sebelum disimpan ke dalam database.
    // Created. event ini dijalankan saat model telah berhasil disimpan ke dalam database.
    // Updating. event yang dijalankan saat perubahan sebuah model dan sebelum selesai disimpan ke dalam database.
    // Updated. event ini dijalankan saat proses perubahan sebuah model dan selesai disimpan ke dalam database.
    // Saving. event ini dijalankan sebelum proses creating atau updating terjadi.
    // Saved. event ini dijalankan ketika proses created atau updated telah selesai.
    // Deleting. event yang terjadi saat sebuah model akan dihapus
    // Deleted. event ini akan dijalankan saat model telah terhapus
    // Restoring. event ini akan dijalankan saat mengembalikan model yang terhapus. Namun, hanya dapat digunakan ketika kita mengimplementasikan soft-delete
    // Restored. event ini akan dijalankan saat proses pengembalian model yang terhapus telah selesai.

    public function saving($value)
    {
        $uuid = \Faker\Factory::create()->uuid;
        $value->code_table = $uuid;

        // $label = Getter('uuid_label');
        // $enum_method = Getter('enum_method');
        // var_dump($value->uuid);
        // if($enum_method == 'create') {
        //     $value->uuid = "$label-$value->user_id-" . prepand_zero(rand(0, 100000), 5);
        // } else {
        //     $value->uuid = empty($value->uuid) ? "$label-$value->user_id-" . prepand_zero(rand(0, 100000), 5) : $value->uuid;
        //     // echo $value->uuid;
        // }
    }
}

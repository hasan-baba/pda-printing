<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values =  [
            ['key' => 'company_name', 'value' => ''],
            ['key' => 'location', 'value' => ''],
            ['key' => 'building', 'value' => ''],
            ['key' => 'po_box', 'value' => ''],
            ['key' => 'city', 'value' => ''],
            ['key' => 'country', 'value' => ''],
            ['key' => 'tel_nb', 'value' => ''],
            ['key' => 'fax', 'value' => ''],
            ['key' => 'img_logo', 'value' => '']
        ];
        DB::table('settings')->insert($values);
    }
}

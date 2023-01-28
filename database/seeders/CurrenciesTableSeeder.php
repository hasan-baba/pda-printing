<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            ['name' => 'Dollars', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'Yen', 'code' => 'JPY', 'symbol' => '¥'],
            ['name' => 'Pounds', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Dollars', 'code' => 'AUD', 'symbol' => '$'],
            ['name' => 'Dollars', 'code' => 'CAD', 'symbol' => '$'],
            ['name' => 'Switzerland Francs', 'code' => 'CHF', 'symbol' => 'CHF'],
            ['name' => 'United Arab Emirates dirham', 'code' => 'AED', 'symbol' => 'د.إ'],
            ['name' => 'Kuwaiti dinar', 'code' => 'KWD', 'symbol' => 'د.ك'],
            ['name' => 'Libyan dinar', 'code' => 'LYD', 'symbol' => 'ل.د'],
            ['name' => 'Lira', 'code' => 'TRY', 'symbol' => '₺'],
            ['name' => 'Liras', 'code' => 'TRL', 'symbol' => '£'],
            ['name' => 'Dinars', 'code' => 'RSD', 'symbol' => 'Дин'],
            ['name' => 'Riyals', 'code' => 'SAR', 'symbol' => 'ریال'],
            ['name' => 'Lebanese Pound', 'code' => 'LBP', 'symbol' => '£']
        ]);
    }
}

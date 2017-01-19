<?php

namespace Leafr\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
            [
                'key' => 'currency',
                'value' => 'DKK',
                'type' => 'string',
                'group' => 'commerce',
                'order' => 0,
                'description' => 'Default currency used on the store'
            ],
            [
                'key' => 'money_format',
                'value' => 'european',
                'type' => 'string',
                'group' => 'commerce',
                'order' => 1,
                'description' => 'Default number formatting. Choose between european (1.000,00) or american (1,000.00)'
            ],
            [
                'key' => 'vat',
                'value' => 25,
                'type' => 'integer',
                'group' => 'commerce',
                'order' => 2,
                'description' => 'Default VAT percentage.'
            ]
            ]);
    }
}
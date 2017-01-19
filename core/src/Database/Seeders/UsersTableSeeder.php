<?php

namespace Leafr\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
                'first_name' => 'Nicki',
                'last_name' => 'Frandsen',
                'email' => 'nf@nickifrandsen.dk',
                'password' => '$2y$10$NnRi/ONdCZVuFLptxEve6eclPMFUGsiUkdFokrHkxkSiR3JFCrDnK'
            ]);
    }
}
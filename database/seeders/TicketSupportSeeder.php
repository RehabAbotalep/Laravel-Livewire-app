<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TicketSupport::factory(2)->create();
    }
}

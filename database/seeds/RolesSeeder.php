<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\roles::class)->states('admin')->create();
        factory(App\Models\roles::class)->states('profesional')->create();
        factory(App\Models\roles::class)->states('neofito')->create();
    }
}

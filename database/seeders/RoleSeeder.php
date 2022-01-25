<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
            "name"=>"super admin"
        ]);
        DB::table("roles")->insert([
            "name"=>"admin"
        ]);
        DB::table("roles")->insert([
            "name"=>"inventory manager"
        ]);
        DB::table("roles")->insert([
            "name"=>"order manager"
        ]);
        DB::table("roles")->insert([
            "name"=>"customer"
        ]);
    }
}

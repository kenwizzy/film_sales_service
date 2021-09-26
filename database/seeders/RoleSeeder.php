<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new \App\Models\Role;
        $customer->name = 'Customer';
        $customer->save();

        $admin = new \App\Models\Role;
        $admin->name = 'Admin';
        $admin->save();
    }
}

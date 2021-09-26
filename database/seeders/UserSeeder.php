<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('admin@admin.com');
        $user->dob = "1925-10-24";
        $user->role_id = 2;
        $user->save();

        $account = new \App\Models\Account;
        $account->user_id = $user->id;
        $account->save();
    }
}

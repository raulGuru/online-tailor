<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        $users = array(
            array(
                'creator' => 1,
                'first_name' => 'John',
                'last_name' => "Doe",
                'email' => 'info@example.com',
                'password' => Hash::make('admin@123'),
                'gender' => 'male',
                'phone' => '1234567890',
                'pin_code' => '400051',
                'address' => '2878 Carriage Lane',
                'status' => 'active',
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        User::truncate();
        User::insert($users);
    }
}

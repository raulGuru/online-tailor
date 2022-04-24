<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
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
        $users = array(
            array(
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'role' => 'editor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'role' => 'contributor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'role' => 'viewer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'role' => 'billing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        Role::truncate();
        Role::insert($users);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'id' => 1,
                'title' => 'Admin',
                'slug' => 'admin'
            ],
            
            [
                'id' => 2,
                'title' => 'User',
                'slug' => 'user'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'slug' => 'teacher'
            ],
        ];

        Role::insert($roles);
    }
}

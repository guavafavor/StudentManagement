<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array('Quản trị viên', 'Quản lí học tập');

        foreach ($roles as $role) {
            $role = Role::create(['name'=>$role]);
        }
    }
}

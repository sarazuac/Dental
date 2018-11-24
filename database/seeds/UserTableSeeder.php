<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_employee = Role::where('name', 'Employee')->first();
        $role_manager  = Role::where('name', 'Manager')->first();
        $role_admin  = Role::where('name', 'Admin')->first();

        $admin = new User();
        $admin->first_name = 'Christian';
        $admin->last_name = 'Sarazua';
        $admin->email = 'sarazuac@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->roles()->attach($role_admin);


        $manager = new User();
        $manager->first_name = 'John';
        $manager->last_name = 'Doe';
        $manager->email = 'manager@gmail.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($role_manager);

        $employee = new User();
        $employee->first_name = 'Jane';
        $employee->last_name = 'Doe';
        $employee->email = 'employee@gmail.com';
        $employee->password = bcrypt('123456');
        $employee->save();
        $employee->roles()->attach($role_employee);
    }
}

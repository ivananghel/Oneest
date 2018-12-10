<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin_user = User::where('email', '=', 'admin@admin.com')->first();
		
        if ($admin_user == null) {
            $admin_user = User::create([
                'email' => 'admin@admin.com',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => Hash::make('admin'),
                'status' => User::USER_STATUS_ACTIVE
            ]);

			$admin_user->roles()->attach(Role::where('name', '=', 'admin')->firstOrFail());
        } else {
            $admin_user->roles()->detach();
            $admin_user->roles()->attach(Role::where('name', '=', 'admin')->firstOrFail());
        }

        // Manager
        $manager = User::where('email', '=', 'store@manager.com')->first();
		
        if ($manager == null) {
            $manager = User::create([
                'email' => 'store@manager.com',
                'first_name' => 'Store',
                'last_name' => 'Manager',
                'password' => Hash::make('admin'),
                'status' => User::USER_STATUS_ACTIVE
            ]);

			$manager->roles()->attach(Role::where('name', '=', 'manager')->firstOrFail());
        } else {
            $manager->roles()->detach();
            $admin_user->roles()->attach(Role::where('name', '=', 'manager')->firstOrFail());
        }

        // Client Manager
        $client_manager = User::where('email', '=', 'client@manager.com')->first();
		
        if ($client_manager == null) {
            $client_manager = User::create([
                'email' => 'client@manager.com',
                'first_name' => 'Client',
                'last_name' => 'Manager',
                'password' => Hash::make('admin'),
                'status' => User::USER_STATUS_ACTIVE
            ]);

			$client_manager->roles()->attach(Role::where('name', '=', 'client_manager')->firstOrFail());
        } else {
            $client_manager->roles()->detach();
            $client_manager->roles()->attach(Role::where('name', '=', 'client_manager')->firstOrFail());
        }


    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_cliente = Role::where('name', 'cliente')->first();
        $role_atm = Role::where('name', 'atm')->first();
        $role_cajero = Role::where('name', 'cajero')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_auditor = Role::where('name', 'auditor')->first();

        $user = new User();
        $user->name = 'Cliente1';
        $user->email = 'cliente1@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_cliente);

        $user = new User();
        $user->name = 'Atm1';
        $user->email = 'atm1@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_atm);

        $user = new User();
        $user->name = 'Cajero1';
        $user->email = 'cajero1@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_cajero);

        $user = new User();
        $user->name = 'admin1';
        $user->email = 'admin1@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Auditor1';
        $user->email = 'auditor1@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_auditor);
    }
}

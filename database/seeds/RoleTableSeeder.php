<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'cliente';
        $role->description = 'Cliente';
        $role->save();

        $role = new Role();
        $role->name = 'atm';
        $role->description = 'ATM';
        $role->save();

        $role = new Role();
        $role->name = 'cajero';
        $role->description = 'Cajero';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Admin';
        $role->save();

        $role = new Role();
        $role->name = 'auditor';
        $role->description = 'Auditor';
        $role->save();
    }
}

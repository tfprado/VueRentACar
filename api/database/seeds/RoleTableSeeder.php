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
        $role_developer = new Role();
        $role_developer->name = "developer";
        $role_developer->description = "A developer user";
        $role_developer->save();

        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->description = "A Editor user";
        $role_editor->save();

        $role_local = new Role();
        $role_local->name = 'local';
        $role_local->description = "A local user";
        $role_local->save();
    }
}

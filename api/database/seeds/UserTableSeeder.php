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
        $role_developer = Role::where('name', 'developer')->first();
        $role_editor = Role::where('name', 'editor')->first();
        $role_local = Role::where('name', 'local')->first();

        $developer = new User();
        $developer->username = 'tprado';
        $developer->email = 'developer@kensingtonhealth.org';
        $developer->password = 'secret';
        $developer->save();
        $developer->roles()->attach($role_developer);

        $editor = new User();
        $editor->username = 'editor';
        $editor->email = 'editor@kensingtonhealth.org';
        $editor->password = 'secret';
        $editor->save();
        $editor->roles()->attach($role_editor);

        $local = new User();
        $local->username = 'Local User';
        $local->email = 'local@kensingtonhealth.org';
        $local->password = 'secret';
        $local->save();
        $local->roles()->attach($role_local);
    }
}

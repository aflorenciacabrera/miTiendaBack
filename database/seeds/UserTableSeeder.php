<?php
use App\User;
use App\Role;
use Illuminate\Database\Seeder;

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

        // $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_empleado = Role::where('name', 'empleado')->first();
        $role_cliente = Role::where('name', 'cliente')->first();

        // $user = new User();
        // $user->name = 'User';
        // $user->email = 'user@example.com';
        // $user->password = bcrypt('12345678');
        // $user->save();
        // $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password =hash('sha256', '12345678');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Empleado 1';
        $user->email = 'empleado1@example.com';
        $user->password = hash('sha256', '12345678');
        $user->save();
        $user->roles()->attach($role_empleado);

        $user = new User();
        $user->name = 'Cliente 1';
        $user->email = 'cliente1@example.com';
        $user->password = hash('sha256', '12345678');
        $user->save();
        $user->roles()->attach($role_cliente);
    }
}

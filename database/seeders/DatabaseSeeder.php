<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
=======
use Illuminate\Database\Seeder;
>>>>>>> a3d4b43 (update laravel files on main)

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        //Crear los permisos
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-view',
            'person-list',
            'person-create',
            'person-edit',
            'person-delete'
        ];

        foreach ($permissions as $permission) {
            $perm = explode( '-', $permission );
            Permission::create(['name' => $permission, 'description' => $perm[0], 'function' => $perm[1]]);
        }


        $user = User::create([
            'username' => 1094246976,
            'password' => Hash::make('1094246976'),
            'email' => 'ajom43@gmail.com',
        ]);


        //Crear una persona y asignarle un usuario
        $person = Person::create([
            'document_type' => 'Cedula de ciudadania',
            'document_number' => 1094246976,
            'first_name' => 'Alvaro',
            'second_name' => 'Jose',
            'first_last_name' => 'Ozuna',
            'second_last_name' => 'Martinez',
            'birthplace' => 'Sincelejo',
            'department' => 'Sucre',
            'birthdate' => '1989-02-01',
            'user_id' => $user->id
        ]);



        //$user = User::create([
        //    'username' => 1102,
        //    'password' => Hash::make('1102'),
        //    'email' => 'ajom34@gmail.com',
        //    'person_id' => $person->id
        //]);


        //Crear un rol y asignarle los permisos creados
        $role = Role::create(['name' => 'SuperAdmin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);







        $user2 = User::create([
            'username' => 1090464539,
            'password' => Hash::make('1090464539'),
            'email' => 'jessicalozada20@gmail.com',
        ]);


        //Crear una persona y asignarle un usuario
        $person2 = Person::create([
            'document_type' => 'Cedula de ciudadania',
            'document_number' => 1090464539,
            'first_name' => 'Jessica',
            'second_name' => 'Lorena',
            'first_last_name' => 'Lozada',
            'second_last_name' => 'Sanchez',
            'birthplace' => 'Cucuta',
            'department' => 'Norte de Santander',
            'birthdate' => '2003-06-17',
            'user_id' => $user2->id

        ]);



        //Crear un rol y asignarle los permisos creados
        $role2 = Role::create(['name' => 'Admin']);
        //$permissions = Permission::pluck('id', 'id')->all();
        $role2->givePermissionTo('person-edit');
        $user2->assignRole([$role2->id]);
=======
        // \App\Models\User::factory(10)->create();
>>>>>>> a3d4b43 (update laravel files on main)
    }
}

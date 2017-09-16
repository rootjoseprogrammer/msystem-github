<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
          'active' => '1',
          'department_id' => '1',
          'role_id' => '1',
        	'name' => 'admin',
        	'lastname' => 'admin',
        	'cedula' => '00000000',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('secret'),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
          'active' => '1',
          'department_id' => '1',
          'role_id' => '2',
        	'name' => 'admin',
        	'lastname' => 'admin',
        	'cedula' => '00000001',
        	'email' => 'personal@gmail.com',
        	'password' => bcrypt('secret'),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
          'active' => '1',
          'department_id' => '3',
          'role_id' => '1',
          'name' => 'administracion',
          'lastname' => 'administracion',
          'cedula' => '00000003',
          'email' => 'adminis@gmail.com',
          'password' => bcrypt('secret'),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
          'active' => '1',
          'department_id' => '2',
          'role_id' => '1',
          'name' => 'mantenimiento',
          'lastname' => 'mantenimiento',
          'cedula' => '00000004',
          'email' => 'manteni@gmail.com',
          'password' => bcrypt('secret'),
          'created_at' => date("Y-m-d H:i:s"),
          'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}

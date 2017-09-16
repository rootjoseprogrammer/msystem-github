<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'informatica',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);
        
        DB::table('departments')->insert([
            'name' => 'mantenimiento',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'administracion',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'recursos humanos',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);
        
        DB::table('departments')->insert([
            'name' => 'servicios sociales',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'coordinacion de enfermeria',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'docencia de enfermeria',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'control de gestion',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'asesoria legal',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'vigilancia y comunicacion',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'saniamiento',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'prensa',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'sala situacional',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'direccion',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'historias medicas',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'laboratorios',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'consulta de personal',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'rayos x',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'audiometria',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'banco de sangre',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'nutricion y dietetica',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'epidemiologia',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'hematologia',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'anatomia patologica',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'neurocirugia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'ginecologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'neumonologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'medicina interna consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'gastroentereologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'toxicologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'salud ocupacional',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'oftalmologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'cardiologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'neurologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'odontologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'otorrino consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'rehabilitacion consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'oncologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'urologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'remautologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'radio terapia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'nefrologia consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'osteosintesis consulta',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

        DB::table('departments')->insert([
            'name' => 'unidad de cuidados intensivos',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ]);

    }
}
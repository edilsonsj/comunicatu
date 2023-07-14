<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Departamento de Trânsito',
                'email' => 'transito@example.com',
                
            ],
            [
                'name' => 'Departamento de Saúde',
                'email' => 'saude@example.com',
            ],
            [
                'name' => 'Departamento de Educação',
                'email' => 'educacao@example.com',
            ],
            [
                'name' => 'Departamento de Finanças',
                'email' => 'financas@example.com',
            ],
            [
                'name' => 'Departamento de Obras',
                'email' => 'obras@example.com',
            ],
            [
                'name' => 'Departamento de Cultura',
                'email' => 'cultura@example.com',
            ],
            [
                'name' => 'Departamento de Esportes',
                'email' => 'esportes@example.com',
            ],
            [
                'name' => 'Departamento de Meio Ambiente',
                'email' => 'meioambiente@example.com',
            ],
            [
                'name' => 'Departamento de Assistência Social',
                'email' => 'assistenciasocial@example.com',
            ],
            [
                'name' => 'Departamento de Turismo',
                'email' => 'turismo@example.com',
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}

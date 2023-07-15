<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartmentAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = [
            'Trânsito',
            'Saneamento',
            'Iluminação',
            'Obras Públicas',
            'Meio Ambiente',
            'Assistência Social',
            'Educação',
            'Saúde',
            'Cultura',
            'Turismo',
        ];

        foreach ($assignments as $index => $assignment) {
            $departmentId = $index + 1;

            DB::table('departments_assignments')->insert([
                'department_id' => $departmentId,
                'assignment' => $assignment,
            ]);
        }
    }
}

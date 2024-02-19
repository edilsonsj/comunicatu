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
                'name' => 'Departamento de Segurança Pública',
                'email' => 'segurancapublica@example.com',
            ],
            [
                'name' => 'Departamento de Desenvolvimento Econômico',
                'email' => 'desenvolvimentoeconomico@example.com',
            ],
            [
                'name' => 'Departamento de Planejamento Urbano',
                'email' => 'planejamentourbano@example.com',
            ],
            [
                'name' => 'Departamento de Habitação',
                'email' => 'habitacao@example.com',
            ],
            [
                'name' => 'Departamento de Transporte Público',
                'email' => 'transportepublico@example.com',
            ],
            [
                'name' => 'Departamento de Agricultura e Abastecimento',
                'email' => 'agriculturaeabastecimento@example.com',
            ],
            [
                'name' => 'Departamento de Finanças Públicas',
                'email' => 'financaspublicas@example.com',
            ],
            [
                'name' => 'Departamento de Recursos Humanos',
                'email' => 'recursoshumanos@example.com',
            ],
            [
                'name' => 'Departamento de Tecnologia da Informação',
                'email' => 'tecnologiainformacao@example.com',
            ],
            [
                'name' => 'Departamento de Comunicação Social',
                'email' => 'comunicacaosocial@example.com',
            ],
            [
                'name' => 'Departamento de Gestão de Projetos',
                'email' => 'gestaodeprojetos@example.com',
            ],
            [
                'name' => 'Departamento de Relações Internacionais',
                'email' => 'relacoesinternacionais@example.com',
            ],
            [
                'name' => 'Departamento de Defesa Civil',
                'email' => 'defesacivil@example.com',
            ],
            [
                'name' => 'Departamento de Gestão de Resíduos',
                'email' => 'gestaoderesiduos@example.com',
            ],
            [
                'name' => 'Departamento de Controle Urbano',
                'email' => 'controleurbano@example.com',
            ],
            [
                'name' => 'Departamento de Patrimônio Histórico e Cultural',
                'email' => 'patrimoniohistorico@example.com',
            ],
            [
                'name' => 'Departamento de Política para Mulheres',
                'email' => 'politicaparamulheres@example.com',
            ],
            [
                'name' => 'Departamento de Esporte e Lazer',
                'email' => 'esportelazer@example.com',
            ],
            [
                'name' => 'Departamento de Políticas para Juventude',
                'email' => 'politicasparajuventude@example.com',
            ],
            [
                'name' => 'Departamento de Direitos Humanos',
                'email' => 'direitoshumanos@example.com',
            ]
        ];


        DB::table('departments')->insert($departments);
    }
}

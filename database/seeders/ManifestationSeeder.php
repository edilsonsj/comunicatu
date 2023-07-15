<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ManifestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $total_records = 50;

        $statuses = ['Open', 'In Progress', 'Closed'];
        $types = ['Complaint', 'Request', 'Feedback'];

        // Coordenadas aproximadas de Catu-Ba
        $latitudeMin = -12.3667;
        $latitudeMax = -12.2869;
        $longitudeMin = -38.4294;
        $longitudeMax = -38.2977;

        for ($i = 0; $i < $total_records; $i++) {
            $userId = random_int(1, 20);
            $departmentId = random_int(1, 10);
            $description = $faker->paragraph();
            $type = $faker->randomElement($types);
            $status = $faker->randomElement($statuses);
            $lat = $faker->latitude($latitudeMin, $latitudeMax);
            $lon = $faker->longitude($longitudeMin, $longitudeMax);
            $finishedAt = $status === 'Closed' ? $faker->dateTimeBetween('-1 year', 'now') : null;

            DB::table('manifestations')->insert([
                'user_id' => $userId,
                'department_id' => $departmentId,
                'description' => $description,
                'type' => $type,
                'status' => $status,
                'lat' => $lat,
                'lon' => $lon,
                'finished_at' => $finishedAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

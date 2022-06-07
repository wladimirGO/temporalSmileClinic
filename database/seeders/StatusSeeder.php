<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name' => 'Pendiente'],
            ['name' => 'Cancelada'],
            ['name' => 'Pospuesta'],
            ['name' => 'Completada']
            
        ];

        foreach ($status as $st) {
            Status::create($st);
        }
    }
}

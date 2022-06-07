<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use App\Models\AppoimentTreatments;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       $this->call([RolSeeder::class]);
       $this->call([StatusSeeder::class]);
        User::factory()->create([
            'email' => 'admin@smileclinic.com',
            'password' => bcrypt('123456'),
            'name' => 'Smile Clinic',
            'phone_number' => '123456789',
            'rol_id' => 1,
            'dni'=> '1',
        ]);
        User::factory()->create([
            'email' => 'paola@smileclinic.com',
            'password' => bcrypt('123456'),
            'name' => 'Paola',
            'phone_number' => '123456789',
            'rol_id' => 2,
            'dni'=> '20624646',
        ]);
        Patient::factory()->create([
            'address' => 'San Cristobal',
            'name' => 'Luis Diamanti',
            'phone_number' => '123456789',
            'dni'=> '12964786',
        ]);
        $this->call([TreatmentSeeder::class]);

        User::factory(10)->create();

        Patient::factory(50)->create();

        $appointments = Appointment::factory(50)->create();

        foreach ($appointments as $key => $appointment) {
            $n=rand(1,3);
            $array= [];
            $count =0;
            while($n>$count){

                $n2 = Treatment::all()->random()->id;
                if(!in_array($n2,$array)){
                    array_push($array,$n2);
                    $count++;
                }
            }
            foreach ($array as $key => $item) {
                $treatment = Treatment::findOrFail($item);
                AppoimentTreatments::factory()->create([
                    'treatment_id' => $treatment->id,
                    'appointment_id' => $appointment->id,
                    'amount'=> $treatment->price,
                    'count'=> rand(1,3)
                ]);
            }
        }




    }
}

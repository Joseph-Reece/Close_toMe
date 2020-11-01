<?php

use Illuminate\Database\Seeder;
use App\prescription;

class prescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        prescription::create([
            'id' => 1,
            'patient_id' => 2,
            'diagnosis' => 'common flu',
            'prescription' => 'Piriton two tablets after every 8 hours',
            'doctor_id' => 4

        ]);
    }
}

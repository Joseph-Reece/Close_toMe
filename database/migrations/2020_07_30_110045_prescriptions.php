<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->integer('appointment_id');
            $table->text('diagnosis')->nullable();
            $table->text('prescription')->nullable();
            $table->integer('doctor_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('prescriptions');
    }
}

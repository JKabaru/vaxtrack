<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfantVaccineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infant_vaccine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infant_id');
            $table->unsignedBigInteger('vaccine_id');
            $table->date('administration_date')->nullable();
            $table->integer('dosage')->nullable();
            $table->boolean('completed')->default(false);
            $table->date('next_due_date')->nullable();

            // Add any other relevant fields

            $table->foreign('infant_id')->references('id')->on('infants')->onDelete('cascade');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
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
        Schema::dropIfExists('infant_vaccine');
    }
}

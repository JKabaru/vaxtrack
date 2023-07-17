<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowthParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('growth_parameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infant_id');
            $table->date('Date');
            $table->float('Height');
            $table->float('Weight');
            $table->float('HeadCircumference');
            $table->timestamps();

            $table->foreign('infant_id')->references('id')->on('infants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('growth_parameters');
    }
}

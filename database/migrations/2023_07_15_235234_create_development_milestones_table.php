<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopmentMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('development_milestones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infant_id');
            $table->string('MilestoneType');
            $table->date('DateAchieved');
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
        Schema::dropIfExists('development_milestones');
    }
}

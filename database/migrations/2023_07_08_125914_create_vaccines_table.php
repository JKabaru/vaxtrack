<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('age_ranges', function (Blueprint $table) {
            $table->id();
            $table->integer('StartAge')->comment('in months');
            $table->integer('EndAge')->comment('in months');
            $table->text('Description')->nullable();
            $table->timestamps();
        });
        
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('CountryName');
            $table->timestamps();
        });
        
        
        
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('dose_number');
            $table->unsignedBigInteger('age_range_id')->nullable(); // Add AgeRangeID field
            $table->text('description')->nullable(); // Add Description field
            $table->text('side_effects')->nullable(); // Add Side Effects field
            $table->text('storage_requirements')->nullable(); // Add Storage Requirements field
            $table->unsignedBigInteger('country_id')->nullable(); // Add CountryID field
            $table->timestamps();
    
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('age_range_id')->references('id')->on('age_ranges')->onDelete('cascade');
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccines');
    }
}

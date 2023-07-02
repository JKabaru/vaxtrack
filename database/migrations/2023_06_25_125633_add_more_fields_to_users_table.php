<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin', 'parent', 'doctor'])->default('user')->after('password');
            $table->string('photo')->nullable()->after('role');
            $table->string('address')->nullable()->after('photo');
            $table->string('phone_number')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['role', 'photo', 'address', 'phone_number']);
            });
        
    }
}

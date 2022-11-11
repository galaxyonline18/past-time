<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('player_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('age');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('nationality');
            $table->string('contact_number');
            $table->string('street_address1');
            $table->string('street_address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code')->nullable();
            $table->string('occupation');
            $table->string('income_source');
            $table->string('validid_type1');
            $table->string('validid_number1');
            $table->string('validid_type2')->nullable();
            $table->string('validid_number2')->nullable();
            $table->string('profile_image')->default('user.png');
            $table->integer('isBanned');
            $table->dateTime('date_banned')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyer_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('city');
            $table->string('address');
            $table->string('gender');
            $table->string('category');
            $table->text('bio');
            $table->text('short_description');
            $table->text('long_description');
            $table->integer('experience');
            $table->text('achievements');
            $table->string('photo');
            $table->integer('mobile_phone');
            $table->text('office_address');
            $table->integer('office_phone');
            $table->date('birth_date');
            $table->text('website');
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
        Schema::dropIfExists('lawyer_profile');
    }
}

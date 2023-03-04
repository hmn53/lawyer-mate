<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHearingStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearing_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('case_id');
            $table->string('judge_name');
            $table->text('description');
            $table->text('judgement');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->text('comments');
            $table->date('next_hearing_date');
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
        Schema::dropIfExists('hearing_status');
    }
}

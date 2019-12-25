<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lawyer_id');
            $table->integer('client_id');
            $table->string('judge_name');
            $table->string('court_type');
            $table->string('category');
            $table->integer('case_members');
            $table->string('status');
            $table->date('date_of_filing');
            $table->date('end_date');
            $table->text('opponent');
            $table->text('description');
            $table->text('comments');
            $table->text('summary');
            $table->text('background');
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
        Schema::dropIfExists('case_table');
    }
}

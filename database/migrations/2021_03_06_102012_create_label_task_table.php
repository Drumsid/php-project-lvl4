<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->id();
            $table->integer('label_id')->unsigned();
            // $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->integer('task_id')->unsigned();
            // $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
        // Schema::create('label_task', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('task_id');
        //     $table->bigInteger('label_id');
        //     $table->timestamps();
        //     $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        //     $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_task');
    }
}

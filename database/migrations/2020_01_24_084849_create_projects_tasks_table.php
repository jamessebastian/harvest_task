<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('projects_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('tasks_id');
            $table->timestamps();

            $table->unique(['projects_id','tasks_id']);

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('tasks_id')->references('id')->on('tasks')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_tasks');
    }
}

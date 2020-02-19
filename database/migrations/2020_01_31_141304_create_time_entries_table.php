<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('time');
            $table->text('notes')->nullable();
            $table->date('date');

            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('tasks_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('time_sheets_id');

            $table->timestamps();

            $table->foreign('time_sheets_id')->references('id')->on('time_sheets');
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('time_entries');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->text('notes');
            $table->string('category');
            $table->date('date');

            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('time_sheets_id');

            $table->timestamps();

            $table->foreign('time_sheets_id')->references('id')->on('time_sheets');
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}

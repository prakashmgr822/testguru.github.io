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
        Schema::create('marksheets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('level')->nullable();
            $table->string('college_name')->nullable();
            $table->string('address')->nullable();
            $table->integer('total_correct_questions');
            $table->integer('total_incorrect_questions');
            $table->integer('total_skipped_questions');
            $table->integer('total_questions');
            $table->double('total_score');
            $table->double('obtained_score');
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
        Schema::dropIfExists('marksheets');
    }
};

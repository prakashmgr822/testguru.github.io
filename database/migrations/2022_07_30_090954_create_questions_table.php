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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->longText('hint')->nullable();
            $table->longText('question');
            $table->longText('option_1');
            $table->longText('option_2');
            $table->longText('option_3');
            $table->longText('option_4');
            $table->integer('answer');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};

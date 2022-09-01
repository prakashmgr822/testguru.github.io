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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->text('description')->nullable();
            $table->decimal('correct_marks')->nullable();
            $table->integer('exam_duration')->nullable();
            $table->decimal('incorrect_marks')->nullable();
            $table->dateTime('target_date')->nullable();
            $table->boolean('status')->default('1');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

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
        Schema::dropIfExists('tests');
    }
};

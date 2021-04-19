<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('exam_type_id')->references('id')->on('exam_types')->onDelete('cascade');
            $table->datetime('started_at');
            $table->datetime('expired_at');
            $table->integer('duration');
            $table->string('access_code');
            $table->boolean('shared');
            $table->boolean('randomized');
            $table->foreignId('regency_id')->references('id')->on('regencies')->onDelete('cascade')->nullable();
            $table->enum('status',['drafted','published'])->default('drafted');
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
        Schema::dropIfExists('exams');
    }
}

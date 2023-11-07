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
        // Schema::create('classroomcodes', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('student_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('users');
        //     $table->foreignId('classroom_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('classrooms');
        //     $table->string('code');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroomcodes');
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            $table->foreign('quiz_id')->on('quizzes')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('question_id')->on('questions')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('quiz_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id')->nullable();
        });

        Schema::dropIfExists('quiz_question');
    }
};
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
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');

            $table->foreign('school_id')->on('schools')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');

            $table->foreign('school_id')->on('schools')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');

            $table->foreign('school_id')->on('schools')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');

            $table->foreign('school_id')->on('schools')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
    }
};
<?php

use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->onDelete('cascade');
            $table->foreignIdFor(Quiz::class, 'quiz_id')->onDelete('cascade');
            $table->foreignIdFor(Question::class, 'question_id')->onDelete('cascade');
            $table->text('answer');
            $table->tinyInteger('is_true')->default(0);
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
        Schema::dropIfExists('answers');
    }
};
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('question_text');
            $table->longText('question_hint')->nullable();
            $table->string('image')->nullable();
            $table->longText('answer_explanation')->nullable();
            $table->string('type')->default('Multiple Choices');
            $table->string('marks')->default('1');
            $table->string('time')->nullable();
            $table->string('time_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);
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
}

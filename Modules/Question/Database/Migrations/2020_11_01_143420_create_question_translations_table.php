<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("question");
            $table->text("answer");
            $table->string('locale')->index();
            $table->unsignedBigInteger("question_id");
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unique(['question_id','locale']);
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
        Schema::dropIfExists('question_translations');
    }
}

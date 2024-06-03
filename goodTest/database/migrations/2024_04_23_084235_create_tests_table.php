<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 150)->unique()->unique();
        });

        Schema::create('difficulties', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50)->unique();
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 100)->unique();
        });

        Schema::create('question_texts', function (Blueprint $table) {
            $table->id();
            $table->text('text');
        });

        Schema::create('possible_answers', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 100)->unique();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_text_id');
            $table->foreign('question_text_id')->references('id')->on('question_texts');

            $table->unsignedBigInteger('possible_answer_id');
            $table->foreign('possible_answer_id')->references('id')->on('possible_answers');
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_token', length: 255)->unique();
            $table->boolean('closed');
            $table->string('name', length: 150);

            $table->unsignedBigInteger('difficult_id');
            $table->foreign('difficult_id')->references('id')->on('difficulties');

            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics');

            $table->timestamps();
        });

        Schema::create('questions_tests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
        });

        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
        });

        Schema::create('tests_categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('result', length: 200);
            $table->text('description');

            $table->unsignedBigInteger('user_test_id');
            $table->foreign('user_test_id')->references('id')->on('user_tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_texts');
        Schema::dropIfExists('possible_answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('questions_tests');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('difficulties');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tests_categories');
        Schema::dropIfExists('user_tests');
        Schema::dropIfExists('reports');
    }
};

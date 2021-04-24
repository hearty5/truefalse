<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrueFalse extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('true_false', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('category1')->nullable();
            $table->text('category2')->nullable();
            $table->string('q1')->nullable();
            $table->text('a1')->nullable();
            $table->string('q2')->nullable();
            $table->text('a2')->nullable();
            $table->string('q3')->nullable();
            $table->text('a3')->nullable();
            $table->string('q4')->nullable();
            $table->text('a4')->nullable();
            $table->string('q5')->nullable();
            $table->text('a5')->nullable();
            $table->string('q6')->nullable();
            $table->text('a6')->nullable();
            $table->string('q7')->nullable();
            $table->text('a7')->nullable();
            $table->string('q8')->nullable();
            $table->text('a8')->nullable();
            $table->string('q9')->nullable();
            $table->text('a9')->nullable();
            $table->string('q10')->nullable();
            $table->text('a10')->nullable();
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
        Schema::dropIfExists('true_false');
    }
}

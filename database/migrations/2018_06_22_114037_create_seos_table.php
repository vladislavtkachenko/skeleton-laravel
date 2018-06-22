<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('document_type');
            $table->string('priority')->nullable();
            $table->string('h1')->nullable();
            $table->string('frequency')->nullable();
            $table->string('robots')->nullable();
            $table->string('state')->nullable();
            $table->string('seo_title')->nullable();

            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('seo_text')->nullable();

            $table->integer('document_id')->unsigned();

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
        Schema::dropIfExists('seos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParragraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parragraphs', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle');
            $table->string('parragraph', 2000);
            $table->string('source');
            $table->unsignedBigInteger('blog_id');

            $table->foreign('blog_id')->references('id')->on('blogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parragraphs');
    }
}

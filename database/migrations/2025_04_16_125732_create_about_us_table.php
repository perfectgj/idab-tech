<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->integer('members_count')->default(0);
            $table->date('opening_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('urls')->nullable();  // Store redirect links as JSON
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->json('vissions')->nullable();  // Store vision list as JSON
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
        Schema::dropIfExists('about_us');
    }
}

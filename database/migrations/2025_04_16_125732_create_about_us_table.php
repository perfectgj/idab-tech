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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->integer('members_count')->default(0);
            $table->date('opening_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('urls')->nullable();
            $table->json('vissions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};

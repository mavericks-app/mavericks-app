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

        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('agencyRole',["admin","client","faker"])->default("client");
            $table->timestamps();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};

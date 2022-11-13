<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('capacity')->nullable();
            $table->string('email')->unique();
            $table->string('number')->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            $table->string('business_permit')->nullable();
            $table->tinyInteger('status')->default(0); // idetify kung verified ang user
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('tourist_spots');
    }
};

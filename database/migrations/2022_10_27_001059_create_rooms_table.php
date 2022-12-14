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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->string('room_number');
            $table->integer('floor');
            $table->tinyInteger('status')->default(1);
            $table->text('description')->nullable();
            $table->float('price')->nullable();
            $table->enum('room_type', ['single', 'double', 'family'])->default('single');
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('rooms');
    }
};

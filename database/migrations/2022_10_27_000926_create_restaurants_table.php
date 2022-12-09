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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('number')->nullable();
            $table->string('location')->nullable();

            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->string('min_price')->nullable(); // Minimum Price
            $table->string('max_price')->nullable(); // Maximum Price

            $table->longText('description')->nullable();

            $table->string('business_permit')->nullable();

            $table->tinyInteger('status')->default(0); // idetify kung verified business
            
            $table->tinyInteger('is_archived')->default(0);

            $table->string('picture')->nullable();
            
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('restaurants');
    }
};

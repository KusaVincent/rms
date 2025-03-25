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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('location_id');
            $table->string('property_name');
            $table->text('description');
            $table->text('property_image');
            $table->integer('rent');
            $table->integer('deposit');
            $table->boolean('availability')->default(true);
            $table->timestamps();

            $table->foreign('property_type_id')->references('id')->on('property_types')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

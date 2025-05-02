<?php

declare(strict_types=1);

use App\Models\Property;
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
        Schema::create('property_media', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Property::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->text('image_one');
            $table->text('image_two')->nullable();
            $table->text('image_three')->nullable();
            $table->text('image_four')->nullable();
            $table->text('image_five')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_media');
    }
};

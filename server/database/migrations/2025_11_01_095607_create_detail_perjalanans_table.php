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
        Schema::create('detail_perjalanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_id')->constrained('perjalanans')->onDelete('cascade');
            $table->timestamp('recorded_at');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('speed_kmh', 6, 2)->nullable();
            $table->decimal('heading', 6, 2)->nullable();
            $table->decimal('gps_accuracy_m', 6, 2)->nullable();
            $table->boolean('is_driver_facing_camera')->nullable();
            $table->decimal('face_detection_confidence', 5, 4)->nullable();
            $table->string('face_image_url', 500)->nullable();
            $table->binary('face_embedding')->nullable();
            $table->decimal('drowsiness_level', 3, 2)->nullable();
            $table->string('event_type', 50)->nullable();
            $table->json('event_metadata')->nullable();
            $table->boolean('alarm_played')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_perjalanans');
    }
};

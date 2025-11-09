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
        Schema::create('peringatan_penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('perjalanan_id')->nullable()->constrained('perjalanans')->onDelete('set null');
            $table->foreignId('detail_perjalanan_id')->nullable()->constrained('detail_perjalanans')->onDelete('set null');
            $table->enum('alert_type', ['drowsiness', 'face_mismatch', 'off_road', 'hard_brake', 'emergency_button', 'geofence_breach', 'speeding']);
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->text('message');
            $table->timestamp('timestamp')->useCurrent();
            $table->boolean('is_acknowledged')->default(false);
            $table->string('acknowledged_by', 100)->nullable();
            $table->timestamp('acknowledged_at')->nullable();
            $table->boolean('resolved')->default(false);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peringatan_penggunas');
    }
};

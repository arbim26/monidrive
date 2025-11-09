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
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('perjalanan_id')->nullable()->constrained('perjalanans')->onDelete('set null');
            $table->foreignId('detail_perjalanan_id')->nullable()->constrained('detail_perjalanans')->onDelete('set null');
            $table->enum('alarm_type', ['local_alarm', 'push_notification', 'call']);
            $table->enum('triggered_by', ['system', 'user', 'alert']);
            $table->timestamp('triggered_at')->useCurrent();
            $table->boolean('success')->default(false);
            $table->json('response_metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};

<?php

use App\Models\CameraGroup;
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
        Schema::create('alarm_camera_group', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Alarm::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(cameraGroup::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_camera_group');
    }
};

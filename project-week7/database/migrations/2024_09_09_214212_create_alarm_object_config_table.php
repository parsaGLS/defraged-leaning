<?php

use App\Models\Alarm;
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
        Schema::create('alarm_object_config', function (Blueprint $table) {
            $table->foreignIdFor(Alarm::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\ObjectConfig::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_object_config');
    }
};

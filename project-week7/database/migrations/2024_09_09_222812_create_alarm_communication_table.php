<?php

use App\Models\Alarm;
use App\Models\Communication;
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
        Schema::create('alarm_communication', function (Blueprint $table) {
            $table->foreignIdFor(Alarm::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Communication::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_communication');
    }
};

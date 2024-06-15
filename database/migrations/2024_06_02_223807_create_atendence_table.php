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
        Schema::create('atendence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_shift_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->time('time');
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendence');
    }
};

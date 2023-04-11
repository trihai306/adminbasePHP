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
        Schema::create('sms_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('service_id');
            $table->string('phone');
            $table->string('code');
            $table
                ->enum('status', ['active', 'pending', 'block'])
                ->default('active');
            $table->string('sms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_histories');
    }
};

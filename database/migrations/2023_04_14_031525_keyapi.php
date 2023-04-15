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
        Schema::create('key_api', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('member_id');
            $table->string('key');
            $table
                ->enum('status', ['active', 'pending', 'block'])
                ->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_api');
    }
};

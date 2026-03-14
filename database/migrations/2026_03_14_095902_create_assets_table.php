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
        Schema::create('assets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id');

            $table->string('location')->nullable();

            $table->foreignId('department_id')->nullable();

            $table->string('asset_id')->unique();

            $table->string('asset_type');

            $table->string('ip')->nullable();

            $table->string('serial_number')->nullable();

            $table->string('model')->nullable();

            $table->string('os')->nullable();

            $table->string('ram')->nullable();

            $table->string('manufacturing')->nullable();

            $table->string('storage')->nullable();

            $table->string('assigned_user')->nullable();

            $table->string('email')->nullable();

            $table->string('old_user')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

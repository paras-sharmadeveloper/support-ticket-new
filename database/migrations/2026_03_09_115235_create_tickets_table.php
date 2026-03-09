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
        Schema::create('tickets', function (Blueprint $table) {

            $table->id();

            $table->string('ticket_number');

            $table->string('title');

            $table->text('description');

            $table->string('priority');

            $table->string('status')->default('open');

            $table->foreignId('department_id');

            $table->foreignId('created_by');

            $table->foreignId('assigned_to')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

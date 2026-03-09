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
        Schema::table('email_settings', function (Blueprint $table) {
            $table->string('imap_host')->nullable();
            $table->string('imap_port')->nullable();
            $table->string('imap_username')->nullable();
            $table->string('imap_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_settings', function (Blueprint $table) {
            //
        });
    }
};

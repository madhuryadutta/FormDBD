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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('allowedDomains')->default('*');
            $table->string('publishablesecretkey');
            $table->json('additional_data')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('soft_delete')->default(false);
            $table->timestamps();
            $table->index('publishablesecretkey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};

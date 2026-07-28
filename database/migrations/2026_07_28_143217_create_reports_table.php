<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('accountant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('type'); // revenue, expense, tax_summary, cash_flow
            $table->string('period'); // e.g. "2024-Q1", "2024-05", "2024"
            $table->string('file_path')->nullable();
            $table->json('data')->nullable(); // chart data
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

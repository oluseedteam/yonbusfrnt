<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('client')->after('password'); // admin, accountant, client
            $table->string('phone')->nullable()->after('role');
            $table->string('company_name')->nullable()->after('phone');
            $table->string('tax_identification_number')->nullable()->after('company_name');
            $table->text('address')->nullable()->after('tax_identification_number');
            $table->string('avatar')->nullable()->after('address');
            $table->boolean('dark_mode')->default(false)->after('avatar');
            $table->boolean('is_active')->default(true)->after('dark_mode');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'company_name', 'tax_identification_number', 'address', 'avatar', 'dark_mode', 'is_active']);
        });
    }
};

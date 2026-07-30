<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('client')->after('password');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'tax_identification_number')) {
                $table->string('tax_identification_number')->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('tax_identification_number');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'dark_mode')) {
                $table->boolean('dark_mode')->default(false)->after('avatar');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('dark_mode');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = array_filter(['role', 'phone', 'company_name', 'tax_identification_number', 'address', 'avatar', 'dark_mode', 'is_active'], fn($c) => Schema::hasColumn('users', $c));
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'assigned_admin_id')) {
                $table->foreignId('assigned_admin_id')->nullable()->after('role')->constrained('users')->nullOnDelete();
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'assigned_admin_id')) {
                $table->foreignId('assigned_admin_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'assigned_admin_id')) {
                $table->dropForeign(['assigned_admin_id']);
                $table->dropColumn('assigned_admin_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'assigned_admin_id')) {
                $table->dropForeign(['assigned_admin_id']);
                $table->dropColumn('assigned_admin_id');
            }
        });
    }
};

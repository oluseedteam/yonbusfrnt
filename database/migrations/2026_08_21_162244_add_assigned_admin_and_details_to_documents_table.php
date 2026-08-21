<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'assigned_admin_id')) {
                $table->foreignId('assigned_admin_id')->nullable()->after('uploaded_by')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('documents', 'type')) {
                $table->string('type')->default('other')->after('assigned_admin_id');
            }
            if (!Schema::hasColumn('documents', 'notes')) {
                $table->text('notes')->nullable()->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'assigned_admin_id')) {
                $table->dropForeign(['assigned_admin_id']);
                $table->dropColumn('assigned_admin_id');
            }
            if (Schema::hasColumn('documents', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('documents', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};

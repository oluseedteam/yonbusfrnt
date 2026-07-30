<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SetupRolesAndPermissionsCommand extends Command
{
    protected $signature = 'permission:setup';
    protected $description = 'Seed Spatie roles and permissions for YONBUS platform';

    public function handle(): int
    {
        $this->info('Setting up Spatie roles and permissions...');

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Permissions list
        $permissions = [
            // User management
            'view-users', 'create-users', 'edit-users', 'delete-users', 'toggle-user-status',
            // Client management
            'view-clients', 'create-clients', 'edit-clients', 'delete-clients',
            // Accountant management
            'view-accountants', 'create-accountants', 'edit-accountants', 'delete-accountants',
            // Services
            'view-services', 'create-services', 'edit-services', 'delete-services', 'toggle-services',
            // Appointments
            'view-appointments', 'create-appointments', 'edit-appointments', 'cancel-appointments', 'complete-appointments',
            // Documents
            'view-documents', 'upload-documents', 'delete-documents', 'download-documents',
            // Reports & Analytics
            'view-reports', 'export-reports',
            // Audit & System Settings
            'view-activity-logs', 'manage-settings',
            // Blogs
            'view-blogs', 'create-blogs', 'edit-blogs', 'delete-blogs', 'publish-blogs',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // 2. Roles list
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $admin      = Role::firstOrCreate(['name' => 'admin',       'guard_name' => 'web']);
        $accountant = Role::firstOrCreate(['name' => 'accountant',  'guard_name' => 'web']);
        $client     = Role::firstOrCreate(['name' => 'client',      'guard_name' => 'web']);

        // Super Admin gets all permissions
        $superAdmin->syncPermissions(Permission::all());

        // Admin permissions
        $admin->syncPermissions([
            'view-users', 'create-users', 'edit-users', 'delete-users', 'toggle-user-status',
            'view-clients', 'create-clients', 'edit-clients', 'delete-clients',
            'view-accountants', 'create-accountants', 'edit-accountants', 'delete-accountants',
            'view-services', 'create-services', 'edit-services', 'delete-services', 'toggle-services',
            'view-appointments', 'create-appointments', 'edit-appointments', 'cancel-appointments', 'complete-appointments',
            'view-documents', 'upload-documents', 'delete-documents', 'download-documents',
            'view-reports', 'export-reports',
            'view-activity-logs', 'manage-settings',
            'view-blogs', 'create-blogs', 'edit-blogs', 'delete-blogs', 'publish-blogs',
        ]);

        // Accountant permissions
        $accountant->syncPermissions([
            'view-clients', 'view-services',
            'view-appointments', 'complete-appointments', 'cancel-appointments',
            'view-documents', 'upload-documents', 'download-documents',
            'view-reports',
        ]);

        // Client permissions
        $client->syncPermissions([
            'view-services',
            'view-appointments', 'create-appointments', 'cancel-appointments',
            'view-documents', 'upload-documents', 'download-documents',
        ]);

        $this->info('Roles and permissions successfully setup!');
        return Command::SUCCESS;
    }
}

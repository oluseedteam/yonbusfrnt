<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $accountants = DB::table('users')
            ->where('role', 'accountant')
            ->orWhereExists(function ($q) {
                $q->select(DB::raw(1))
                  ->from('model_has_roles')
                  ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                  ->whereColumn('model_has_roles.model_id', 'users.id')
                  ->where('roles.name', 'accountant');
            })
            ->pluck('id');

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $now  = now();

        foreach ($accountants as $accountantId) {
            foreach ($days as $day) {
                $exists = DB::table('availability_slots')
                    ->where('accountant_id', $accountantId)
                    ->where('day_of_week', $day)
                    ->exists();

                if (!$exists) {
                    DB::table('availability_slots')->insert([
                        'accountant_id' => $accountantId,
                        'day_of_week'   => $day,
                        'start_time'    => '09:00:00',
                        'end_time'      => '17:00:00',
                        'is_available'  => true,
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        // This seeder migration does not roll back data intentionally
    }
};

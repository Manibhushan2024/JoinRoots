<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('services')->whereIn('title', [
            'ABA Therapy',
            'Applied Behavior Analysis',
            'ABA',
            'Occupational Therapy',
            'OT',
            'Behaviour Therapy',
            'Behavioral Therapy',
            'Behaviour',
            'Behavior Therapy',
            'Sensory Integration',
            'Sensory Integration Therapy',
            'Sensory',
        ])->delete();

        // Also catch by keyword in title (case-insensitive)
        DB::table('services')
            ->where(function ($q) {
                $q->where('title', 'like', '%ABA%')
                  ->orWhere('title', 'like', '%Occupational%')
                  ->orWhere('title', 'like', '%Sensory Integration%')
                  ->orWhere('title', 'like', '%Behaviour Therapy%')
                  ->orWhere('title', 'like', '%Behavioral Therapy%');
            })
            ->delete();
    }

    public function down(): void
    {
        // Intentionally empty — deleted records cannot be automatically restored.
    }
};

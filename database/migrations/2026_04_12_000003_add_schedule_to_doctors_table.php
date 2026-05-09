<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->json('available_days')->nullable()->after('display_order');
            // e.g. ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
            $table->string('work_start_time', 5)->default('09:00')->after('available_days');
            $table->string('work_end_time', 5)->default('18:00')->after('work_start_time');
            $table->integer('slot_duration')->default(60)->after('work_end_time');
            // in minutes per session (for slot generation)
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['available_days', 'work_start_time', 'work_end_time', 'slot_duration']);
        });
    }
};

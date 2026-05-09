<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('online_discount', 8, 2)->default(0)->after('online_price');
            $table->decimal('offline_discount', 8, 2)->default(0)->after('offline_price');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['online_discount', 'offline_discount']);
        });
    }
};

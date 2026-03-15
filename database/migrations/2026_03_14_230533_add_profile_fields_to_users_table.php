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
            $table->string('phone')->nullable()->after('email');
            $table->integer('age')->nullable()->after('phone');
            $table->string('relation_with_child')->nullable()->after('age');
            $table->text('address')->nullable()->after('relation_with_child');
            $table->string('profile_image')->nullable()->after('address');
            $table->text('medical_history')->nullable()->after('profile_image');
            $table->boolean('is_admin')->default(false)->after('medical_history');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'age', 'relation_with_child', 'address',
                'profile_image', 'medical_history', 'is_admin'
            ]);
        });
    }
};

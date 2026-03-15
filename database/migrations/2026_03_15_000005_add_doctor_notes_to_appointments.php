<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable()->after('service_id');
            $table->text('admin_notes')->nullable()->after('meet_link');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });
    }
    public function down(): void {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['doctor_id', 'admin_notes']);
        });
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('invoice_number')->nullable()->after('status');
            $table->text('notes')->nullable()->after('invoice_number');
        });
    }
    public function down(): void {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['invoice_number', 'notes']);
        });
    }
};

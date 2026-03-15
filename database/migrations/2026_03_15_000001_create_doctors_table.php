<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('qualification')->nullable();
            $table->text('bio')->nullable();
            $table->string('specializations')->nullable(); // comma-separated
            $table->integer('experience_years')->default(1);
            $table->string('photo_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('doctors'); }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable(); // e.g. "Mother of a 7-year-old"
            $table->string('location')->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->text('review_text');
            $table->string('avatar_color')->default('#2D6A4F');
            $table->boolean('is_approved')->default(false);
            $table->integer('display_order')->default(0);
            $table->unsignedBigInteger('service_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('reviews'); }
};

<?php

use App\Enums\ClassFormat;
use App\Enums\ContentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_category_id')->constrained()->cascadeOnDelete();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('overview')->nullable();
            $table->json('benefits')->nullable();
            $table->string('level')->nullable(); // e.g., Beginner, Intermediate, All Levels
            $table->string('duration_text')->nullable(); // e.g., "60 mins / session"
            $table->string('format')->default(ClassFormat::Either->value)->index();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status')->default(ContentStatus::Draft->value)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};

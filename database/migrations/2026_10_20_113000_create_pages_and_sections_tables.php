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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // e.g. '/', 'about-us', 'contact-us', 'wadeem-gardens'
            $table->longText('body')->nullable();
            $table->boolean('in_navbar')->default(false);
            $table->integer('navbar_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });

        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->string('section_key'); // e.g. 'hero', 'overview', 'investment', 'services', etc.
            $table->string('section_name'); // e.g. 'Hero Section', 'Residential Overview'
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('content')->nullable(); // structured key-value pairs
            $table->timestamps();

            $table->unique(['page_id', 'section_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
        Schema::dropIfExists('pages');
    }
};

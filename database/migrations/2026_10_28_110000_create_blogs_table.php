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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('News'); // News, Coming Soon, Real Estate
            $table->text('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('faqs')->nullable();
            $table->string('status')->default('publish'); // publish, draft
            $table->boolean('is_published')->default(true);
            $table->string('author')->nullable()->default('Hudayriyat Editorial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

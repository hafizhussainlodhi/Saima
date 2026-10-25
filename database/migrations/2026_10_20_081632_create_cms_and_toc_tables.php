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
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('group')->default('general');
            $table->string('label');
            $table->string('type')->default('text'); // text, textarea, rich
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        Schema::create('toc_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('target_id'); // e.g., 'saimaAboutDev', 'saimaLocation'
            $table->tinyInteger('level')->default(2); // 2 = H2, 3 = H3
            $table->foreignId('parent_id')->nullable()->constrained('toc_items')->nullOnDelete();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toc_items');
        Schema::dropIfExists('cms_contents');
    }
};

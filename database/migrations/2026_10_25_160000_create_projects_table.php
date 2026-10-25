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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('location')->nullable()->default('Hudayriyat Island, Abu Dhabi');
            $table->string('price')->nullable(); // e.g. 'Launch Price: 8.7M AED'
            $table->string('delivery_date')->nullable(); // e.g. 'Delivery Date: Q2 2031'
            $table->string('developer')->nullable()->default('Modon Properties');
            $table->string('payment_plan')->nullable(); // e.g. 'Flexible Payment Plan'
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

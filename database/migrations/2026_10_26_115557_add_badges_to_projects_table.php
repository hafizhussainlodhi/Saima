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
        Schema::table('projects', function (Blueprint $table) {
            $table->json('badges')->nullable()->after('location');
        });

        // Clear existing card launch price and delivery date strings as requested
        \Illuminate\Support\Facades\DB::table('projects')->update([
            'price' => null,
            'delivery_date' => null,
            'badges' => json_encode(['Off plan']),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('badges');
        });
    }
};

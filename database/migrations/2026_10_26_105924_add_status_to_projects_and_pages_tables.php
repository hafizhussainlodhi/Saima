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
        if (Schema::hasTable('projects') && !Schema::hasColumn('projects', 'status')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('status', 30)->default('publish')->after('is_active');
            });
        }

        if (Schema::hasTable('pages') && !Schema::hasColumn('pages', 'status')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->string('status', 30)->default('publish')->after('is_published');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('projects') && Schema::hasColumn('projects', 'status')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasTable('pages') && Schema::hasColumn('pages', 'status')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};

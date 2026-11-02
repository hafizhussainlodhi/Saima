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
        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                if (!Schema::hasColumn('projects', 'show_in_projects')) {
                    $table->boolean('show_in_projects')->default(true)->after('is_active');
                }
                if (!Schema::hasColumn('projects', 'show_in_commercial')) {
                    $table->boolean('show_in_commercial')->default(false)->after('show_in_projects');
                }
            });
        }

        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                if (!Schema::hasColumn('pages', 'show_in_projects')) {
                    $table->boolean('show_in_projects')->default(true)->after('in_navbar');
                }
                if (!Schema::hasColumn('pages', 'show_in_commercial')) {
                    $table->boolean('show_in_commercial')->default(false)->after('show_in_projects');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                if (Schema::hasColumn('projects', 'show_in_commercial')) {
                    $table->dropColumn('show_in_commercial');
                }
                if (Schema::hasColumn('projects', 'show_in_projects')) {
                    $table->dropColumn('show_in_projects');
                }
            });
        }

        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                if (Schema::hasColumn('pages', 'show_in_commercial')) {
                    $table->dropColumn('show_in_commercial');
                }
                if (Schema::hasColumn('pages', 'show_in_projects')) {
                    $table->dropColumn('show_in_projects');
                }
            });
        }
    }
};

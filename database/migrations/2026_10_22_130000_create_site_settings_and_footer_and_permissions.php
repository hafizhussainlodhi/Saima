<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add role & granular permissions to users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('admin')->after('password');
            }
            if (!Schema::hasColumn('users', 'permissions')) {
                $table->json('permissions')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('permissions');
            }
        });

        // 2. Global site settings (for SEO, Indexing, and global configs)
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->longText('value')->nullable();
                $table->string('type')->default('string');
                $table->string('group')->default('general');
                $table->timestamps();
            });
        }

        // 3. Footer sections & columns (for Brand, Newsletter, Columns with links, Bottom bar)
        if (!Schema::hasTable('footer_sections')) {
            Schema::create('footer_sections', function (Blueprint $table) {
                $table->id();
                $table->string('brand_title')->nullable()->default('Saima');
                $table->text('brand_description')->nullable();
                $table->string('newsletter_title')->nullable()->default('Subscribe to Our Newsletter');
                $table->string('newsletter_subtitle')->nullable()->default('Get the latest updates and property offers delivered to your inbox.');
                $table->boolean('newsletter_enabled')->default(false);
                $table->json('social_links')->nullable();
                $table->json('columns')->nullable();
                $table->text('disclaimer_text')->nullable();
                $table->string('copyright_text')->nullable()->default('© 2026 hudayriyat-island.ae All Rights Reserved.');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_sections');
        Schema::dropIfExists('site_settings');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'permissions', 'is_active']);
        });
    }
};

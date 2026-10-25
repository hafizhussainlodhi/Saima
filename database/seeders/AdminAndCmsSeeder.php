<?php

namespace Database\Seeders;

use App\Models\CmsContent;
use App\Models\TocItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAndCmsSeeder extends Seeder
{
    /**
     * Seed the default admin user, CMS content blocks and TOC items.
     * Safe to re-run: existing admin passwords and edited CMS values are never overwritten.
     */
    public function run(): void
    {
        // 1. Default Admin User (only created if it does not exist)
        User::firstOrCreate(
            ['email' => 'admin@hudayriyat.com'],
            [
                'name' => 'Hudayriyat Admin',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );

        // 2. CMS content blocks from config/cms.php (keeps admin-edited values)
        foreach (config('cms.content', []) as $key => $item) {
            $record = CmsContent::firstOrNew(['key' => $key]);
            $record->group = $item['group'];
            $record->label = $item['label'];
            $record->type = $item['type'];
            if (! $record->exists) {
                $record->value = $item['value'];
            }
            $record->save();
        }

        // 3. Default Table of Contents items (only if the TOC is empty)
        if (TocItem::count() === 0) {
            foreach (config('cms.toc', []) as $index => $toc) {
                TocItem::create([
                    'title' => $toc['title'],
                    'target_id' => $toc['target_id'],
                    'level' => 2,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}

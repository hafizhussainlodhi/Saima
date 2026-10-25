<?php

use App\Models\CmsContent;
use App\Models\TocItem;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

if (! function_exists('cms')) {
    /**
     * Get an editable CMS text value by key.
     * Falls back to the default in config/cms.php if the DB value is empty or the DB is unreachable.
     */
    function cms(string $key, ?string $default = null): string
    {
        static $values = null;

        if ($values === null) {
            try {
                $values = CmsContent::allKeyed();
            } catch (\Throwable $e) {
                $values = [];
            }
        }

        $value = $values[$key] ?? null;

        if ($value === null || $value === '') {
            $value = $default ?? config("cms.content.{$key}.value", '');
        }

        return (string) $value;
    }
}

if (! function_exists('cms_br')) {
    /**
     * CMS value escaped with new lines converted to <br>.
     */
    function cms_br(string $key, ?string $default = null): HtmlString
    {
        return new HtmlString(nl2br(e(cms($key, $default)), false));
    }
}

if (! function_exists('cms_lines')) {
    /**
     * CMS "list" value split into an array (one item per line).
     */
    function cms_lines(string $key): array
    {
        return array_values(array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', cms($key))),
            fn ($line) => $line !== ''
        ));
    }
}

if (! function_exists('toc_items')) {
    /**
     * Active Table of Contents tree (top-level items with children).
     */
    function toc_items(): Collection
    {
        try {
            return TocItem::getTree();
        } catch (\Throwable $e) {
            return collect(config('cms.toc', []))->map(fn ($item) => (object) array_merge($item, [
                'level' => 2,
                'children' => collect(),
            ]));
        }
    }
}

if (! function_exists('toc_title')) {
    /**
     * Title of a TOC item by its anchor id (keeps article H2 headings in sync with the TOC).
     */
    function toc_title(string $targetId, string $default): string
    {
        static $titles = null;

        if ($titles === null) {
            try {
                $titles = TocItem::titleMap();
            } catch (\Throwable $e) {
                $titles = [];
            }
        }

        return $titles[$targetId] ?? $default;
    }
}

if (! function_exists('page_data')) {
    /**
     * Retrieve current or specified Page model with sections.
     */
    function page_data(?string $slug = null): ?\App\Models\Page
    {
        try {
            $targetSlug = $slug ?? request()->path();
            return \App\Models\Page::findBySlug($targetSlug);
        } catch (\Throwable $e) {
            return null;
        }
    }
}

if (! function_exists('page_section')) {
    /**
     * Retrieve content of a page section with fallback.
     */
    function page_section(string $sectionKey, string $fieldKey, $default = null, ?string $pageSlug = null)
    {
        try {
            $page = page_data($pageSlug);
            if ($page) {
                $val = $page->sectionField($sectionKey, $fieldKey);
                if ($val !== null && $val !== '') {
                    return $val;
                }
            }
        } catch (\Throwable $e) {
            // Graceful fallback on missing DB/table
        }
        return $default;
    }
}

if (! function_exists('navbar_pages')) {
    /**
     * Retrieve all published pages marked for navbar inclusion.
     */
    function navbar_pages(): \Illuminate\Support\Collection
    {
        return \App\Models\Page::navbarPages();
    }
}

if (! function_exists('toc_content')) {
    /**
     * Retrieve the rendered HTML content of an article section by target_id.
     */
    function toc_content(string $targetId, string $default = ''): HtmlString
    {
        static $contents = null;

        if ($contents === null || app()->runningUnitTests()) {
            try {
                $contents = TocItem::contentMap();
            } catch (\Throwable $e) {
                $contents = [];
            }
        }

        $val = $contents[$targetId] ?? null;

        if (!empty(trim($val ?? ''))) {
            return new HtmlString($val);
        }

        return new HtmlString($default);
    }
}

if (! function_exists('toc_image')) {
    /**
     * Retrieve the image URL/path of a TOC section by target_id with optional fallback.
     */
    function toc_image(string $targetId, ?string $default = null): ?string
    {
        static $images = null;

        if ($images === null || app()->runningUnitTests()) {
            try {
                $images = TocItem::imageMap();
            } catch (\Throwable $e) {
                $images = [];
            }
        }

        return $images[$targetId] ?? $default;
    }
}

if (! function_exists('footer_data')) {
    /**
     * Retrieve dynamic footer configuration.
     */
    function footer_data(): \App\Models\FooterSection
    {
        return \App\Models\FooterSection::current();
    }
}

if (! function_exists('is_indexing_enabled')) {
    /**
     * Check if search engine indexing is enabled globally.
     */
    function is_indexing_enabled(): bool
    {
        return \App\Models\SiteSetting::isIndexingEnabled();
    }
}

if (! function_exists('site_setting')) {
    /**
     * Retrieve a global site setting by key.
     */
    function site_setting(string $key, $default = null)
    {
        return \App\Models\SiteSetting::get($key, $default);
    }
}


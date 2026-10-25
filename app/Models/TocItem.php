<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TocItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'target_id',
        'level',
        'parent_id',
        'order',
        'is_active',
        'content',
        'image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
        'order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(TocItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(TocItem::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get TOC tree for rendering.
     */
    public static function getTree()
    {
        return Cache::rememberForever('toc_items_tree', function () {
            return static::active()
                ->whereNull('parent_id')
                ->with(['children' => function ($q) {
                    $q->active()->ordered();
                }])
                ->ordered()
                ->get();
        });
    }

    /**
     * Map of target_id => title (all items, used for article H2 headings).
     */
    public static function titleMap(): array
    {
        return Cache::rememberForever('toc_items_titles', function () {
            return static::pluck('title', 'target_id')->toArray();
        });
    }

    /**
     * Map of target_id => content (all items, used for article section content).
     */
    public static function contentMap(): array
    {
        return Cache::rememberForever('toc_items_contents', function () {
            return static::pluck('content', 'target_id')->toArray();
        });
    }

    /**
     * Default content for an article section by target_id.
     */
    public static function getDefaultContent(string $targetId): string
    {
        $defaults = [
            'about-the-developers' => "<p class=\"saimaP\">\n    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.\n</p>\n<p class=\"saimaP\">\n    The developer is mainly interested in contemporary urban design and building design. In addition, <a href=\"https://theleadmarketing.com/\" target=\"_blank\" rel=\"noopener noreferrer\">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.\n</p>",

            'saima-mangrove-residences-noc' => "<p class=\"saimaP\">\n    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.\n</p>\n<p class=\"saimaP\">\n    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.\n</p>\n<p class=\"saimaP\">\n    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.\n</p>",

            'saima-mangrove-residences-location' => "<p class=\"saimaP\">\n    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.\n</p>\n<p class=\"saimaP\">\n    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.\n</p>\n<p class=\"saimaP\">\n    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.\n</p>",

            'saima-mangrove-residences-location-map' => "<p class=\"saimaP\">\n    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.\n</p>\n<p class=\"saimaP\">\n    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.\n</p>\n<p class=\"saimaP\">\n    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.\n</p>",

            'saima-mangrove-residences-floor-plan' => "<p class=\"saimaP\">\n    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.\n</p>",

            'saima-mangrove-residences-master-plan' => "<p class=\"saimaP\">\n    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.\n</p>\n<p class=\"saimaP\">\n    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.\n</p>\n<p class=\"saimaP\">\n    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.\n</p>",

            'saima-mangrove-residences-payment-plan' => "<p class=\"saimaP\">\n    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.\n</p>",

            'saima-mangrove-residences-installation-plan' => "<p class=\"saimaP\">\n    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.\n</p>\n<p class=\"saimaP\">\n    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.\n</p>\n<p class=\"saimaP\">\n    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.\n</p>",

            'apartments-for-sale-in-saima-mangrove-residences' => "<p class=\"saimaP\">\n    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.\n</p>\n<p class=\"saimaP\">\n    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.\n</p>\n<p class=\"saimaP\">\n    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.\n</p>",

            'facilities-and-amenities' => "<p class=\"saimaP\">\n    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.\n</p>\n<p class=\"saimaP\">\n    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.\n</p>\n<p class=\"saimaP\">\n    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href=\"https://theleadmarketing.com/\" target=\"_blank\" rel=\"noopener noreferrer\">Lead Marketing team.</a>\n</p>",
        ];

        return $defaults[$targetId] ?? '';
    }

    /**
     * Resolved content (custom database content, or default content).
     */
    public function resolvedContent(): string
    {
        if (!empty(trim($this->content ?? ''))) {
            return $this->content;
        }

        return static::getDefaultContent($this->target_id);
    }

    /**
     * Map of target_id => image (all items, used for article section images).
     */
    public static function imageMap(): array
    {
        return Cache::rememberForever('toc_items_images', function () {
            return static::whereNotNull('image')->where('image', '!=', '')->pluck('image', 'target_id')->toArray();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('toc_items_tree');
        Cache::forget('toc_items_titles');
        Cache::forget('toc_items_contents');
        Cache::forget('toc_items_images');
    }

    protected static function booted()
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsContent;
use App\Models\Lead;
use App\Models\TocItem;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'total'    => Lead::count(),
            'new'      => Lead::where('status', 'new')->count(),
            'today'    => Lead::where('created_at', '>=', $today)->count(),
            'week'     => Lead::where('created_at', '>=', $today->copy()->subDays(6))->count(),
            'cms'      => CmsContent::count(),
            'toc'      => TocItem::where('is_active', true)->count(),
        ];

        // Leads per day for the last 14 days (for the mini bar chart)
        $start = $today->copy()->subDays(13);
        $counts = Lead::where('created_at', '>=', $start)
            ->get(['created_at'])
            ->groupBy(fn ($lead) => $lead->created_at->format('Y-m-d'))
            ->map->count();

        $chart = collect(range(0, 13))->map(function ($i) use ($start, $counts) {
            $day = $start->copy()->addDays($i);
            return [
                'label' => $day->format('d M'),
                'short' => $day->format('D'),
                'count' => $counts[$day->format('Y-m-d')] ?? 0,
            ];
        });

        $statusBreakdown = collect(config('cms.lead_statuses'))->map(fn ($label, $key) => [
            'label' => $label,
            'count' => Lead::where('status', $key)->count(),
        ]);

        $recentLeads = Lead::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'chart', 'statusBreakdown', 'recentLeads'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);

        $leads = $query->latest()->paginate(20)->withQueryString();
        $statuses = config('cms.lead_statuses');
        $projects = Lead::query()->distinct()->orderBy('project')->pluck('project')->filter();
        $counts = Lead::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('admin.leads.index', compact('leads', 'statuses', 'projects', 'counts'));
    }

    public function show(Lead $lead)
    {
        $statuses = config('cms.lead_statuses');

        return view('admin.leads.show', compact('lead', 'statuses'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(config('cms.lead_statuses')))],
        ]);

        $lead->update($data);

        return back()->with('success', "Lead #{$lead->id} marked as " . config("cms.lead_statuses.{$data['status']}") . '.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', "Lead #{$lead->id} deleted.");
    }

    /**
     * Export (filtered) leads as CSV.
     */
    public function export(Request $request)
    {
        $leads = $this->filteredQuery($request)->latest()->get();
        $filename = 'hudayriyat-leads-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($leads) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel
            fputcsv($out, ['ID', 'Name', 'Phone', 'Email', 'Project', 'Comment', 'Country', 'Status', 'IP Address', 'Submitted At']);
            foreach ($leads as $lead) {
                fputcsv($out, [
                    $lead->id, $lead->name, $lead->phone, $lead->email, $lead->project,
                    $lead->comment, $lead->country, $lead->status, $lead->ip_address,
                    $lead->created_at?->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    private function filteredQuery(Request $request)
    {
        return Lead::query()
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->query('q') . '%';
                $q->where(fn ($w) => $w->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('phone', 'like', $term)
                    ->orWhere('comment', 'like', $term));
            })
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->query('status')))
            ->when($request->filled('project'), fn ($q) => $q->where('project', $request->query('project')));
    }
}

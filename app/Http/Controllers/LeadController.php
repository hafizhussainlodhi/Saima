<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeadController extends Controller
{
    /**
     * Store a newly created lead in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'comment' => 'nullable|string|max:2000',
            'project' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:10',
            'page_url' => 'nullable|string|max:1000',
            'campaign_url' => 'nullable|string|max:1000',
        ]);

        $ip = $request->ip();

        // Determine exact page URL from payload or request headers
        $rawPageUrl = $validated['page_url']
            ?? $request->input('page_url')
            ?? ($request->filled('campaign_url') && !in_array(rtrim($request->input('campaign_url'), '/'), ['https://saimaprojects.com', 'http://saimaprojects.com'], true) ? $request->input('campaign_url') : null)
            ?? $request->header('referer')
            ?? $validated['campaign_url']
            ?? $request->input('campaign_url')
            ?? $request->input('url')
            ?? $request->header('origin')
            ?? url()->previous();

        $pageUrl = !empty($rawPageUrl) ? (string) $rawPageUrl : url('/');

        $lead = Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'comment' => $validated['comment'] ?? ($request->input('key_requirement') ?? null),
            'project' => $validated['project'] ?? 'Saima Projects',
            'country' => $validated['country'] ?? null,
            'page_url' => $pageUrl,
            'ip_address' => $ip,
            'status' => 'new',
        ]);

        // Construct exact n8n JSON payload format
        $n8nPayload = [
            'name' => (string) ($request->input('name') ?? $validated['name'] ?? ''),
            'phone' => (string) ($request->input('phone') ?? $validated['phone'] ?? ''),
            'email' => (string) ($request->input('email') ?? $validated['email'] ?? ''),
            'source' => (string) ($request->input('source') ?: 'Website'),
            'sub_source' => 'saima project',
            'utm_campaign' => (string) ($request->input('utm_campaign') ?: ($request->query('utm_campaign') ?: '')),
            'campaign_url' => (string) $pageUrl,
            'page_url' => (string) $pageUrl,
            'url' => (string) $pageUrl,
            'source_page_url' => (string) $pageUrl,
            'project' => (string) ($request->input('project') ?: ($lead->project ?: 'Saima Projects')),
            'developer' => (string) ($request->input('developer') ?: 'Saima Group'),
            'community' => (string) ($request->input('community') ?: ($request->input('project') ?: 'Saima Projects')),
            'property_type' => (string) ($request->input('property_type') ?: 'Residential'),
            'key_requirement' => (string) ($request->input('key_requirement') ?: ($request->input('comment') ?: '')),
            'activity_description' => (string) ($request->input('activity_description') ?: 'General Website Lead Submission'),
        ];

        // Dispatch to n8n Webhook
        $this->dispatchToN8n($n8nPayload);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your appointment request has been received. Our property specialist will contact you shortly.',
                'lead_id' => $lead->id,
            ]);
        }

        return back()->with('success', 'Thank you! Your appointment request has been received.');
    }

    /**
     * Dispatch lead payload to n8n webhook with header authentication token.
     */
    protected function dispatchToN8n(array $payload)
    {
        $url = config('services.n8n.webhook_url') 
            ?: env('N8N_WEBHOOK_URL', 'https://n8n.srv1625508.hstgr.cloud/webhook/979a4b97-a515-4ee0-96e3-5d0ddb475e99');
        $token = config('services.n8n.token') 
            ?: env('N8N_WEBHOOK_TOKEN', 'fsa_n8n_secret_token_2026_x99a');

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-Token' => $token,
            'X-Auth-Token' => $token,
            'token' => $token,
        ];

        try {
            $response = Http::withHeaders($headers)
                ->withoutVerifying()
                ->timeout(10)
                ->post($url, $payload);

            \Illuminate\Support\Facades\Log::info('n8n Webhook Sent', [
                'status' => $response->status(),
                'response' => $response->body(),
                'payload' => $payload,
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('n8n Webhook Error: ' . $e->getMessage(), [
                'payload' => $payload,
            ]);
            return false;
        }
    }

    /**
     * Detect user country and dial code based on IP
     */
    public function detectCountry(Request $request)
    {
        $country = $request->header('CF-IPCountry') 
            ?? $request->header('X-Country-Code') 
            ?? 'AE';

        $dialCodes = [
            'AE' => '+971',
            'PK' => '+92',
            'IN' => '+91',
            'SA' => '+966',
            'QA' => '+974',
            'OM' => '+968',
            'KW' => '+965',
            'BH' => '+973',
            'GB' => '+44',
            'US' => '+1',
            'CA' => '+1',
            'AU' => '+61',
            'RU' => '+7',
            'DE' => '+49',
            'FR' => '+33',
        ];

        $code = strtoupper($country);
        $dialCode = $dialCodes[$code] ?? '+971';

        return response()->json([
            'country' => $code,
            'dialCode' => $dialCode,
        ]);
    }
}
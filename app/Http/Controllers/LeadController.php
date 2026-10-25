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
        ]);

        $ip = $request->ip();

        $lead = Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'comment' => $validated['comment'] ?? null,
            'project' => $validated['project'] ?? 'Hudayriyat Island',
            'country' => $validated['country'] ?? null,
            'ip_address' => $ip,
            'status' => 'new',
        ]);

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
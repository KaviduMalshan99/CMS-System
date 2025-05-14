<?php

namespace App\Http\Controllers;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'inquiry_source' => 'required|in:Platform,WhatsApp,Email,Call',
        'description' => 'required|string',
    ]);

    // Add missing required fields
    $validated['status'] = 'New';
    $validated['assigned_to_user_id'] = null;

    Inquiry::create($validated);

    return redirect()->back()->with('success', 'Inquiry created successfully.');
}

}

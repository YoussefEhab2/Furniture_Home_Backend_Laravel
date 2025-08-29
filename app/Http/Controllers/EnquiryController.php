<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    // Submit Enquiry
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'customer_id' => 'required|integer',
        ]);

        $enquiry = Enquiry::create([
            'description' => $request->description,
            'customer_id' => $request->customer_id,
        ]);

        return response()->json([
            'message' => 'Enquiry submitted successfully',
            'data' => $enquiry
        ], 201);
    }
   public function index()
{
    
    $enquiries = Enquiry::all();

   
    return response()->json($enquiries);
}

public function hide($id)
    {
        $enquiry = Enquiry::find($id);

        if (!$enquiry) {
            return response()->json(['error' => 'Enquiry not found'], 404);
        }

        if ($enquiry->is_hidden) {
            return response()->json([
                'message' => 'Enquiry already hidden',
                'enquiry' => $enquiry
            ], 200);
        }

        $enquiry->is_hidden = true;
        $enquiry->save();

        return response()->json([
            'message' => 'Enquiry hidden successfully',
            'enquiry' => $enquiry
        ], 200);
    }
}

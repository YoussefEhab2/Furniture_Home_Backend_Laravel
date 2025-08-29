<?php
namespace App\Http\Controllers;
use App\Models\Storesetting;
use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    // update platform info (admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'               => 'nullable|string|max:255',
            'logo_url'           => 'nullable|string|max:1023',
            'about_image_url'    => 'nullable|string|max:1023',
            'about_description'  => 'nullable|string|max:1023',
            'terms_and_conditions' => 'nullable|string|max:1023',
            'facebook_url'       => 'nullable|string|max:1023',
            'whatsapp_no'        => 'nullable|string|max:20',
            'phone_no'           => 'nullable|string|max:20',
            'second_phone_no'    => 'nullable|string|max:20',
        ]);

        $store = StoreSetting::find($id);

        if (!$store) {
            return response()->json(['error' => 'Store settings not found'], 404);
        }

        $store->update($request->all());

        return response()->json([
            'message' => 'Platform info updated successfully',
            'store'   => $store
        ]);
    }

    // view platform info (anyone)
    public function show()
    {
        $store = StoreSetting::first();
        return response()->json($store);
    }
    public function showTerms($id)
{
    $store = StoreSetting::find($id);

    if (!$store) {
        return response()->json(['error' => 'Store not found'], 404);
    }

    return response()->json([
        'terms_and_conditions' => $store->terms_and_conditions
    ]);
}

}

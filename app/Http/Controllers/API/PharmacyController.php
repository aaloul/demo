<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use App\Models\PharmacyImage;
use Illuminate\Support\Facades\Storage;

class PharmacyController extends Controller
{
    public function index()
    {
        return PharmacyResource::collection(Pharmacy::paginate(10));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255']
        ]);

        
        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('uploads/pharmacies', 'public');
        }
        $pharmacy = Pharmacy::create($validatedData);
        $pharmacy->save();

        if (isset($validatedData['gallery'])) {
            foreach ($validatedData['gallery'] as $file) {
                $pharmacyImages = new PharmacyImage(['path' => $file->store('uploads/pharmacy_images/' . $pharmacy->id, 'public'), 'pharmacy_id' => $pharmacy->id]);
                $pharmacyImages->save();
            }
        }
        
        return response(new PharmacyResource($pharmacy), 201);
    }

    public function show(Pharmacy $pharmacy)
    {
        return new PharmacyResource($pharmacy);
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {

    }

    public function destroy(Pharmacy $pharmacy)
    {
        foreach($pharmacy->images() as $image) {
            Storage::disk('public')->delete($image);
        }
        $pharmacy->images()->detach($pharmacy->id);
        Storage::disk('public')->delete($pharmacy->logo);
        $pharmacy->delete();
        
        return response(null, 204);
    }
}

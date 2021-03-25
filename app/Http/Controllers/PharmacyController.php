<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\PharmacyImage;

class PharmacyController extends Controller
{

    public function list(Request $request) {
        $pharmacies = Pharmacy::when($request->has('term'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->input('term') . '%');
        })->paginate(10);
        return view('admin.pharmacies.list', compact('pharmacies'));
    }

    public function create($stepSlug = null)
    {
        $step = $stepSlug ?? 'basic';
        
        return view('admin.pharmacies.form', ['step' => $step]);
    }

    public function store(Request $request, $stepSlug = null)
    {
        switch($stepSlug) {
            case "basic": 
                return $this->basicStep($request);
            case "images":
                return $this->imagesStep($request);
            case "contact":
                return $this->contactStep($request);
            default:
                abort(404);
        }
    }

    private function basicStep($request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255']
        ]);
        if(empty($request->session()->get('pharmacy'))) {
            $pharmacy = new Pharmacy();
            $pharmacy->fill($validatedData);
            $request->session()->put('pharmacy', $pharmacy);
        }else{
            $pharmacy = $request->session()->get('pharmacy');
            $pharmacy->fill($validatedData);
            $request->session()->put('pharmacy', $pharmacy);
        }
        return redirect()->route('pharmacies.create', ['step' => 'images']);
    }

    private function imagesStep($request) {
        $validatedData = $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $pharmacy = $request->session()->get('pharmacy');
        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('uploads/pharmacies', 'public');
        }
        $pharmacy->fill(['logo' => $validatedData['logo']]);
        $pharmacy->save();
        $request->session()->put('pharmacy', $pharmacy);
        if (isset($validatedData['gallery'])) {
            foreach ($validatedData['gallery'] as $file) {
                $pharmacyImages = new pharmacyImage(['path' => $file->store('uploads/pharmacy_images/' . $pharmacy->id, 'public'), 'pharmacy_id' => $pharmacy->id]);
                $pharmacyImages->save();
            }
        }
        return redirect()->route('pharmacies.create', ['step' => 'contact']);
    }

    private function contactStep($request) {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255']
        ]);
        $pharmacy = $request->session()->get('pharmacy');
        $pharmacy->fill($validatedData);
        $pharmacy->save();

        $request->session()->forget('pharmacy');
        
        return redirect()->route('pharmacies.list');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{

    // ================= ADMIN =================

    public function index()
    {
        $packages = TourPackage::with('destination')
            ->latest()
            ->get();

        return view('packages.index', compact('packages'));
    }



    public function create()
    {
        $destinations = Destination::orderBy('name')->get();

        return view('packages.create', compact('destinations'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'category'       => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'duration_days'  => 'required|integer|min:1',
            'quota'          => 'required|integer|min:1',
            'departure_date' => 'nullable|date',
            'status'         => 'required|in:active,inactive',
        ]);

        TourPackage::create($validated);

        return redirect()
            ->route('admin.package.index')
            ->with('success', 'Paket wisata berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $package = TourPackage::findOrFail($id);

        $destinations = Destination::orderBy('name')->get();

        return view('packages.edit', compact(
            'package',
            'destinations'
        ));
    }



    public function update(Request $request, $id)
    {
        $package = TourPackage::findOrFail($id);

        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'category'       => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'duration_days'  => 'required|integer|min:1',
            'quota'          => 'required|integer|min:1',
            'departure_date' => 'nullable|date',
            'status'         => 'required|in:active,inactive',
        ]);

        $package->update($validated);

        return redirect()
            ->route('admin.package.index')
            ->with('success', 'Paket wisata berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $package = TourPackage::findOrFail($id);

        $package->delete();

        return redirect()
            ->route('admin.package.index')
            ->with('success', 'Paket wisata berhasil dihapus.');
    }

}
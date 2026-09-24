<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();

        return view(
            'destinations.index',
            compact('destinations')
        );
    }

    /**
     * Halaman detail publik untuk satu destinasi.
     */
    public function show(Destination $destination)
{
    $otherDestinations = Destination::where('id', '!=', $destination->id)
        ->where('status', 'active')
        ->inRandomOrder()
        ->limit(3)
        ->get();

    $relatedPackages = $destination->tourPackages()
        ->where('status', 'active')
        ->latest()
        ->get();

    return view('destinations.show', [
        'destination' => $destination,
        'otherDestinations' => $otherDestinations,
        'relatedPackages' => $relatedPackages,
    ]);
}

    public function create()
    {
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'location'    => 'required',
            'description' => 'nullable',
            'open_time'   => 'required',
            'close_time'  => 'required',
            'image'       => 'nullable|image',
            'video_url'   => 'nullable|url',
            'status'      => 'required',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('destinations', 'public');
        }

        Destination::create($data);

        return redirect()
            ->route('admin.destination.index')
            ->with(
                'success',
                'Destinasi berhasil ditambahkan'
            );
    }

    public function edit(Destination $destination)
    {
        return view(
            'destinations.edit',
            compact('destination')
        );
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'location'    => 'required',
            'description' => 'nullable',
            'open_time'   => 'required',
            'close_time'  => 'required',
            'image'       => 'nullable|image',
            'video_url'   => 'nullable|url',
            'status'      => 'required',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()
            ->route('admin.destination.index')
            ->with(
                'success',
                'Destinasi berhasil diperbarui'
            );
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()
            ->route('admin.destination.index')
            ->with(
                'success',
                'Destinasi berhasil dihapus'
            );
    }
}
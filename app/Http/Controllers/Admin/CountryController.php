<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->paginate(20);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:countries',
                'code' => 'required|string|max:10|unique:countries',
            ]);

            $country = Country::create([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'slug' => Str::slug($request->name),
            ]);

            // Handle AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Country created successfully.'
                ]);
            }

            return redirect()->route('admin.countries.index')
                ->with('success', 'Country created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
            'code' => 'required|string|max:10|unique:countries,code,' . $country->id,
        ]);

        $country->update([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        // Check if country has videos
        if ($country->videos()->count() > 0) {
            return redirect()->route('admin.countries.index')
                ->with('error', 'Cannot delete country with existing videos.');
        }

        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\SolarPanelCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolarPanelCompany;

class SolarPanelCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = SolarPanelCompany::orderBy('created_at', 'desc')->get();
        return view('admin.solarPanelCompany.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $solarCompany = null;
        if ($request->has('id')) {
            $company = SolarPanelCompany::find($request->input('id'));
        }
        return view('admin.solarPanelCompany.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:solar_panel_companies,name',
        ]);

        SolarPanelCompany::create($validated);

        return redirect()->route('solar-panel-company.index')
            ->with('success', 'Solar Panel Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = SolarPanelCompany::findOrFail($id);
        return view('admin.solar-panel-company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = SolarPanelCompany::findOrFail($id);
        return view('admin.solarPanelCompany.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = SolarPanelCompany::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:solar_panel_companies,name,' . $company->id,
        ]);

        $company->update($validated);

        return redirect()->route('solar-panel-company.index')
            ->with('success', 'Solar Panel Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = SolarPanelCompany::findOrFail($id);
        $company->delete();

        return redirect()->route('solar-panel-company.index')
            ->with('success', 'Solar Panel Company deleted successfully.');
    }

    public function getAllSolarPanelCompanies()
    {
        $solarPanelCompanies = SolarPanelCompany::orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $solarPanelCompanies
        ]);
    }
}

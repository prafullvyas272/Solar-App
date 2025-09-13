<?php

namespace App\Http\Controllers\InverterCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InverterCompany;

class InverterCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = InverterCompany::orderBy('created_at', 'desc')->get();
        return view('admin.inverterCompany.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $inverterCompany = null;
        if ($request->has('id')) {
            $company = InverterCompany::find($request->input('id'));
        }
        return view('admin.inverterCompany.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:inverter_companies,name',
        ]);

        InverterCompany::create($validated);

        return redirect()->route('inverter-company.index')
            ->with('success', 'Inverter Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = InverterCompany::findOrFail($id);
        return view('admin.inverterCompany.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = InverterCompany::findOrFail($id);
        return view('admin.inverterCompany.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = InverterCompany::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:inverter_companies,name,' . $company->id,
        ]);

        $company->update($validated);

        return redirect()->route('inverter-company.index')
            ->with('success', 'Inverter Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = InverterCompany::findOrFail($id);
        $company->delete();

        return redirect()->route('inverter-company.index')
            ->with('success', 'Inverter Company deleted successfully.');
    }


    public function getAllInverterCompanies()
    {
        $inverterCompanies = InverterCompany::orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $inverterCompanies
        ]);
    }
}

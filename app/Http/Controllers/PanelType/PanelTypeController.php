<?php

namespace App\Http\Controllers\PanelType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PanelType;

class PanelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panelTypes = PanelType::orderBy('created_at', 'desc')->get();
        return view('admin.panelType.index', compact('panelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $panelType = null;
        if ($request->has('id')) {
            $panelType = PanelType::find($request->input('id'));
        }
        return view('admin.panelType.create', compact('panelType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:panel_types,name',
        ]);

        PanelType::create($validated);

        return redirect()->route('panel-type.index')
            ->with('success', 'Panel Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $panelType = PanelType::findOrFail($id);
        return view('admin.panelType.show', compact('panelType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $panelType = PanelType::findOrFail($id);
        return view('admin.panelType.create', compact('panelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $panelType = PanelType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:panel_types,name,' . $panelType->id,
        ]);

        $panelType->update($validated);

        return redirect()->route('panel-type.index')
            ->with('success', 'Panel Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $panelType = PanelType::findOrFail($id);
        $panelType->delete();

        return redirect()->route('panel-type.index')
            ->with('success', 'Panel Type deleted successfully.');
    }


    public function getAllPanelType()
    {
        $panelTypes = PanelType::orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $panelTypes
        ]);
    }
}

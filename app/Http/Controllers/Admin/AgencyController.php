<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agencies;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = Agencies::paginate(10);
        return view('admin.agencies.index', compact('agencies'));
    }

    public function create()
    {
        return view('admin.agencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:agencies',
            'description' => 'nullable|string',
        ]);

        Agencies::create($request->all());

        return redirect()->route('admin.agencies.index')->with('success', 'Agency created successfully.');
    }

    public function show(Agencies $agency)
    {
        return view('admin.agencies.show', compact('agency'));
    }

    public function edit(Agencies $agency)
    {
        return view('admin.agencies.edit', compact('agency'));
    }

    public function update(Request $request, Agencies $agency)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:agencies,name,' . $agency->id,
            'description' => 'nullable|string',
        ]);

        $agency->update($request->all());

        return redirect()->route('admin.agencies.index')->with('success', 'Agency updated successfully.');
    }

    public function destroy(Agencies $agency)
    {
        if ($agency->reports()->count() > 0) {
            return redirect()->route('admin.agencies.index')->with('error', 'Cannot delete agency with associated reports.');
        }

        $agency->delete();

        return redirect()->route('admin.agencies.index')->with('success', 'Agency deleted successfully.');
    }
}

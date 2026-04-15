<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\Categories;
use App\Models\Agencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Auth::user()->reports()->with(['category','agency'])->latest()->paginate(10);
        return view('report.index', compact('reports'));
    }

    public function create()
    {
        $categories = Categories::all();
        $agencies = Agencies::all();
        return view('report.create', compact('categories', 'agencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'agencies_id' => 'required|exists:agencies,id',
            'location' => 'nullable|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate unique daily sequential ticket
        $dateCode = date('Ymd');
        $sequence = Reports::where('ticket_number', 'LIKE', 'REP-' . $dateCode . '-%')->count() + 1;
        $ticketNumber = 'REP-' . $dateCode . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
        
        // Ensure uniqueness
        while (Reports::where('ticket_number', $ticketNumber)->exists()) {
            $sequence++;
            $ticketNumber = 'REP-' . $dateCode . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
        }

        $data = $request->only(['title', 'description', 'categories_id', 'agencies_id', 'location']);
        $data['user_id'] = Auth::id();
        $data['ticket_number'] = $ticketNumber;
        $data['status'] = 'menunggu';

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos/reports', 'public');
            $data['photo'] = $photoPath;
        }

        Reports::create($data);

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dibuat! No Tiket: ' . $ticketNumber);
    }

    public function edit(Reports $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Categories::all();
        $agencies = Agencies::all();
        return view('report.edit', compact('report', 'categories', 'agencies'));
    }

    public function update(Request $request, Reports $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'agencies_id' => 'required|exists:agencies,id',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'categories_id', 'agencies_id', 'location']);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($report->photo) {
                Storage::disk('public')->delete($report->photo);
            }
            $photoPath = $request->file('photo')->store('photos/reports', 'public');
            $data['photo'] = $photoPath;
        }

        $report->update($data);

        return redirect()->route('report.index')->with('success', 'Laporan berhasil diupdate!');
    }

    public function destroy(Reports $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        if ($report->photo) {
            Storage::disk('public')->delete($report->photo);
        }

        $report->delete();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus!');
    }
}

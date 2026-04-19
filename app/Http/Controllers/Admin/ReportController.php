<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Reports::with(['user', 'category', 'agency'])->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Reports $report)
    {
        $report->load(['user', 'category', 'agency', 'responses']);
        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Reports $report)
    {
        if ($report->photo) {
            Storage::disk('public')->delete($report->photo);
        }
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
}

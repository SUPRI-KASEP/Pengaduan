<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Reports::with(['user', 'category', 'agency'])
            ->latest()
            ->paginate(20);
        return view('petugas.reports.index', compact('reports'));
    }

    public function updateStatus(Request $request, Reports $report)
    {
        $allowedStatuses = ['menunggu', 'di-tinjau', 'di-kerjakan', 'selesai'];
        $request->validate([
            'status' => 'required|in:' . implode(',', $allowedStatuses)
        ]);

        $report->update([
            'status' => $request->status
        ]);

        return redirect()->route('petugas.reports.index')->with('success', 'Status laporan berhasil diubah!');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index()
    {
        $reports = Report::with('creator')->get();
        return view('report.index', ['data' => $reports]);
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $users = User::all();
        return view('report.create', compact('users'));
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_date' => 'required|date',
            'type' => 'required|in:monthly,yearly',
            'creator_id' => 'required|exists:users,id',
            'total_buying' => 'nullable|integer|min:0',
            'total_selling' => 'nullable|integer|min:0',
            'other_cost' => 'nullable|integer|min:0',
            'cash_flow' => 'nullable|integer',
        ]);

        try {
            $report = Report::create([
                'report_date' => $validated['report_date'],
                'type' => $validated['type'],
                'creator_id' => $validated['creator_id'],
                'total_buying' => $validated['total_buying'] ?? 0,
                'total_selling' => $validated['total_selling'] ?? 0,
                'other_cost' => $validated['other_cost'] ?? 0,
                'cash_flow' => $validated['cash_flow'] ?? 0,
            ]);
            return redirect()->route('reports.index')->with('status', 'Laporan berhasil dibuat');
        } catch (\Exception $e) {
            Log::error('Report store failed', ['error' => $e->getMessage()]);
            return redirect()->route('reports.index')->with('error', 'Gagal membuat laporan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $report->load(['creator', 'buyingTransactions', 'sellingTransactions']);
        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $users = User::all();
        return view('report.edit', compact('report', 'users'));
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'report_date' => 'required|date',
            'type' => 'required|in:monthly,yearly',
            'creator_id' => 'required|exists:users,id',
            'total_buying' => 'nullable|integer|min:0',
            'total_selling' => 'nullable|integer|min:0',
            'other_cost' => 'nullable|integer|min:0',
            'cash_flow' => 'nullable|integer',
        ]);

        try {
            $report->update([
                'report_date' => $validated['report_date'],
                'type' => $validated['type'],
                'creator_id' => $validated['creator_id'],
                'total_buying' => $validated['total_buying'] ?? 0,
                'total_selling' => $validated['total_selling'] ?? 0,
                'other_cost' => $validated['other_cost'] ?? 0,
                'cash_flow' => $validated['cash_flow'] ?? 0,
            ]);
            return redirect()->route('reports.index')->with('status', 'Laporan berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Report update failed', ['error' => $e->getMessage()]);
            return redirect()->route('reports.index')->with('error', 'Gagal memperbarui laporan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        try {
            $report->delete();
            return redirect()->route('reports.index')->with('status', 'Laporan berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Report delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('reports.index')->with('error', 'Laporan tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail(Request $request)
    {
        $report = Report::with(['creator', 'buyingTransactions', 'sellingTransactions'])->find($request->input('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('report.show', compact('report'))->render()
        ], 200);
    }

    /**
     * Show the create modal via AJAX.
     */
    public function showCreate(Request $request)
    {
        $users = User::all();
        return response()->json([
            'status' => 'ok',
            'msg' => view('report.create', compact('users'))->render()
        ], 200);
    }

    /**
     * Show the edit modal via AJAX.
     */
    public function showEdit(Request $request)
    {
        $report = Report::find($request->input('id'));
        $users = User::all();
        return response()->json([
            'status' => 'ok',
            'msg' => view('report.edit', compact('report', 'users'))->render()
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;

class SystemLogController extends Controller
{    public function index()
    {
        try {
            $logs = SystemLog::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(50);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle case when system_logs table doesn't exist
            if (str_contains($e->getMessage(), "doesn't exist")) {
                return view('admin.logs.index', [
                    'logs' => collect([]),
                    'error' => 'System logs table does not exist. Please create it first.',
                    'createUrl' => url('/create-system-logs-table')
                ]);
            }
            throw $e;
        }

        return view('admin.logs.index', compact('logs'));
    }
}

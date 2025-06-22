<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;

class SystemLogController extends Controller
{
    public function index()
    {
        $logs = SystemLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('admin.logs.index', compact('logs'));
    }
}

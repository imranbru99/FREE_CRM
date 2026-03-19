<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'active_leads'    => Lead::where('status', '!=', 'lost')->count(),
            'pending_tasks'   => Task::where('status', '!=', 'completed')->count(),
            'win_rate'        => $this->calculateWinRate(),
        ];

        $recentLeads = Lead::latest()->take(5)->get();
        $upcomingTasks = Task::with('customer')
            ->where('status', '!=', 'completed')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentLeads', 'upcomingTasks'));
    }

    private function calculateWinRate()
    {
        $total = Lead::count();
        if ($total === 0) return 0;

        $won = Lead::where('status', 'qualified')->count();
        return round(($won / $total) * 100, 1);
    }
}

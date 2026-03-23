@extends('layouts.admin')
@section('title', 'System Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="glass-panel p-6 rounded-3xl hover:scale-[1.02] transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <span class="text-emerald-500 text-xs font-bold">+12% ↑</span>
        </div>
        <h3 class="text-slate-400 text-sm font-medium">Total Customers</h3>
        <p class="text-3xl font-bold mt-1">{{ number_format($stats['total_customers']) }}</p>
    </div>

    <div class="glass-panel p-6 rounded-3xl hover:scale-[1.02] transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-600">
                <i class="fa-solid fa-rocket text-xl"></i>
            </div>
            <span class="text-slate-400 text-xs font-bold">Stable</span>
        </div>
        <h3 class="text-slate-400 text-sm font-medium">Active Leads</h3>
        <p class="text-3xl font-bold mt-1">{{ $stats['active_leads'] }}</p>
    </div>

    <div class="glass-panel p-6 rounded-3xl hover:scale-[1.02] transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-600">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
        </div>
        <h3 class="text-slate-400 text-sm font-medium">Pending Tasks</h3>
        <p class="text-3xl font-bold mt-1">{{ $stats['pending_tasks'] }}</p>
    </div>

    <div class="glass-panel p-6 rounded-3xl hover:scale-[1.02] transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-500/10 flex items-center justify-center text-rose-600">
                <i class="fa-solid fa-chart-pie text-xl"></i>
            </div>
        </div>
        <h3 class="text-slate-400 text-sm font-medium">Conversion Rate</h3>
        <p class="text-3xl font-bold mt-1">{{ $stats['win_rate'] }}%</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 glass-panel rounded-3xl overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold">Recent Leads</h3>
            <a href="{{ route('admin.leads.index') }}" class="text-xs text-blue-500 font-bold uppercase tracking-wider hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentLeads as $lead)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-sm">{{ $lead->name }}</span>
                            <p class="text-xs text-slate-400">{{ $lead->source }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'new' => 'bg-blue-500/10 text-blue-600',
                                    'contacted' => 'bg-amber-500/10 text-amber-600',
                                    'qualified' => 'bg-emerald-500/10 text-emerald-600',
                                    'lost' => 'bg-slate-500/10 text-slate-500',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusColors[$lead->status] }}">
                                {{ $lead->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-400 text-right">
                            {{ $lead->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-10 text-center text-slate-400 text-sm">No recent leads found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="glass-panel rounded-3xl p-6">
        <h3 class="font-bold mb-6">Upcoming Tasks</h3>
        <div class="space-y-6">
            @forelse($upcomingTasks as $task)
            <div class="flex gap-4 relative">
                <div class="flex flex-col items-center">
                    <div class="w-2 h-2 rounded-full {{ $task->due_date < now() ? 'bg-rose-500' : 'bg-blue-500' }}"></div>
                    <div class="w-px h-full bg-slate-100 mt-2"></div>
                </div>
                <div class="pb-6">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">{{ $task->due_date->format('M d, Y') }}</p>
                    <h4 class="text-sm font-semibold">{{ $task->title }}</h4>
                    <p class="text-xs text-slate-500">{{ $task->customer->name ?? 'Internal' }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-slate-400 text-sm py-10">All caught up!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

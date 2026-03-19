@extends('layouts.app')
@section('title', 'Lead Pipeline')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Lead Pipeline</h2>
        <p class="text-slate-500 text-sm">Track potential customers from first contact to qualification.</p>
    </div>
    <a href="{{ route('admin.leads.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium shadow-lg shadow-blue-500/20 transition-all text-center">
        + Add New Lead
    </a>
</div>

<div class="glass-panel rounded-3xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50/50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">Lead Info</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">Source</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">Status</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-white/5">
            @foreach($leads as $lead)
            <tr class="group hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-semibold text-slate-900 dark:text-white">{{ $lead->name }}</div>
                    <div class="text-xs text-slate-400">{{ $lead->email }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $lead->source }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = [
                            'new' => 'bg-blue-500/10 text-blue-600',
                            'contacted' => 'bg-amber-500/10 text-amber-600',
                            'qualified' => 'bg-emerald-500/10 text-emerald-600',
                            'lost' => 'bg-slate-500/10 text-slate-500',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $colors[$lead->status] }}">
                        {{ $lead->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.leads.edit', $lead) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete Lead?')">
                            @csrf @method('DELETE')
                            <button class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100 dark:border-white/5">{{ $leads->links() }}</div>
</div>
@endsection

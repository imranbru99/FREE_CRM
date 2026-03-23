@extends('layouts.admin')
@section('title', 'Task Management')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Tasks & Deadlines</h2>
        <p class="text-slate-500 text-sm">Organize your workflow and track project milestones.</p>
    </div>
    <a href="{{ route('admin.tasks.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium shadow-lg shadow-blue-500/20 transition-all text-center flex items-center justify-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i> New Task
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="glass-panel p-4 rounded-2xl border-l-4 border-blue-500">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Active</p>
        <p class="text-xl font-bold">{{ $tasks->total() }}</p>
    </div>
    <div class="glass-panel p-4 rounded-2xl border-l-4 border-amber-500">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending</p>
        <p class="text-xl font-bold">{{ $tasks->where('status', 'pending')->count() }}</p>
    </div>
    <div class="glass-panel p-4 rounded-2xl border-l-4 border-emerald-500">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Done</p>
        <p class="text-xl font-bold">{{ $tasks->where('status', 'completed')->count() }}</p>
    </div>
</div>

<div class="glass-panel rounded-3xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Task Details</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Related To</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Due Date</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($tasks as $task)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-900 group-hover:text-blue-600 transition-colors">
                                {{ $task->title }}
                            </span>
                            @if($task->description)
                                <span class="text-xs text-slate-400 line-clamp-1 max-w-xs">{{ $task->description }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($task->customer)
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                    {{ substr($task->customer->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-slate-600">
                                    {{ $task->customer->name }}
                                </span>
                            </div>
                        @else
                            <span class="text-xs text-slate-400 italic">Internal Task</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            @php
                                $isOverdue = $task->due_date->isPast() && $task->status !== 'completed';
                            @endphp
                            <span class="text-sm font-medium {{ $isOverdue ? 'text-rose-500' : 'text-slate-600' }}">
                                {{ $task->due_date->format('M d, Y') }}
                            </span>
                            <span class="text-[10px] text-slate-400">{{ $task->due_date->diffForHumans() }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusStyles = [
                                'pending' => 'bg-amber-500/10 text-amber-600 ring-amber-500/20',
                                'in_progress' => 'bg-blue-500/10 text-blue-600 ring-blue-500/20',
                                'completed' => 'bg-emerald-500/10 text-emerald-600 ring-emerald-500/20',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase ring-1 ring-inset {{ $statusStyles[$task->status] ?? 'bg-slate-100 text-slate-600' }}">
                            {{ str_replace('_', ' ', $task->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.tasks.edit', $task) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Archive this task?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                <i class="fa-solid fa-list-check text-2xl"></i>
                            </div>
                            <h3 class="text-slate-900 font-bold">No tasks found</h3>
                            <p class="text-slate-500 text-sm max-w-xs mx-auto">It looks like you're all caught up. Start by creating a new task for your pipeline.</p>
                            <a href="{{ route('admin.tasks.create') }}" class="mt-4 text-blue-500 font-bold text-sm hover:underline">Create your first task</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($tasks->hasPages())
    <div class="p-6 border-t border-slate-100">
        {{ $tasks->links() }}
    </div>
    @endif
</div>
@endsection

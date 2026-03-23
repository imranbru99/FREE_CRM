@extends('layouts.admin')
@section('title', isset($task) ? 'Edit Task' : 'New Task')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold">{{ isset($task) ? 'Update Task' : 'Create New Task' }}</h2>
            <p class="text-slate-400 text-sm">Assign tasks to customers and track deadlines.</p>
        </div>
        <a href="{{ route('admin.tasks.index') }}" class="text-slate-400 hover:text-blue-500 transition-colors"><i class="fa-solid fa-arrow-left mr-2"></i>Back</a>
    </div>

    <form action="{{ isset($task) ? route('admin.tasks.update', $task) : route('admin.tasks.store') }}" method="POST">
        @csrf
        @if(isset($task)) @method('PUT') @endif

        <div class="glass-panel rounded-3xl p-8 shadow-xl space-y-6">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-slate-400 ml-1">Task Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}"
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-slate-400 ml-1">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date', isset($task) ? $task->due_date->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none" required>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-slate-400 ml-1">Related Customer</label>
                    <select name="customer_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none">
                        <option value="">No Customer (Internal)</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ (old('customer_id', $task->customer_id ?? '') == $customer->id) ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-slate-400 ml-1">Task Status</label>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['pending', 'in_progress', 'completed'] as $status)
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="{{ $status }}" class="hidden peer" {{ (old('status', $task->status ?? 'pending') == $status) ? 'checked' : '' }}>
                        <div class="px-4 py-3 text-center border border-slate-200 rounded-2xl peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition-all text-sm font-medium capitalize text-slate-500">
                            {{ str_replace('_', ' ', $status) }}
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-slate-400 ml-1">Description (Optional)</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none">{{ old('description', $task->description ?? '') }}</textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all">
                {{ isset($task) ? 'Save Task Updates' : 'Create Task' }}
            </button>
        </div>
    </form>
</div>
@endsection

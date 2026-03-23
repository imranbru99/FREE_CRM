@extends('layouts.admin')
@section('title', isset($lead) ? 'Edit Lead' : 'Capture New Lead')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div class="animate-in slide-in-from-left duration-500">
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                {{ isset($lead) ? 'Refine Lead Data' : 'New Prospect Entry' }}
            </h2>
            <p class="text-slate-500 text-sm mt-1">
                {{ isset($lead) ? 'Updating information for ' . $lead->name : 'Fill in the details to add a new lead to your sales pipeline.' }}
            </p>
        </div>
        <a href="{{ route('admin.leads.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-blue-500 transition-colors font-medium text-sm">
            <i class="fa-solid fa-arrow-left-long transition-transform group-hover:-translate-x-1"></i>
            Back to Pipeline
        </a>
    </div>

    <form action="{{ isset($lead) ? route('admin.leads.update', $lead) : route('admin.leads.store') }}" method="POST">
        @csrf
        @if(isset($lead)) @method('PUT') @endif

        <div class="glass-panel rounded-3xl p-8 shadow-2xl border-white/20 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 ml-1">Prospect Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <i class="fa-solid fa-user-tag text-xs"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $lead->name ?? '') }}"
                               placeholder="e.g. John Doe"
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 focus:border-blue-500 outline-none transition-all" required>
                    </div>
                    @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 ml-1">Lead Source</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <i class="fa-solid fa-earth-americas text-xs"></i>
                        </span>
                        <input type="text" name="source" value="{{ old('source', $lead->source ?? '') }}"
                               placeholder="e.g. LinkedIn, Website, Referral"
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 focus:border-blue-500 outline-none transition-all" required>
                    </div>
                    @error('source') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $lead->email ?? '') }}"
                           placeholder="prospect@company.com"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 focus:border-blue-500 outline-none transition-all" required>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 ml-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $lead->phone ?? '') }}"
                           placeholder="+1 (555) 000-0000"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                </div>
            </div>

            <div class="space-y-4 border-t border-slate-100 pt-8">
                <label class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 ml-1">Lead Status</label>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $statuses = [
                            'new' => ['icon' => 'fa-star', 'color' => 'blue'],
                            'contacted' => ['icon' => 'fa-comment-dots', 'color' => 'amber'],
                            'qualified' => ['icon' => 'fa-check-double', 'color' => 'emerald'],
                            'lost' => ['icon' => 'fa-circle-xmark', 'color' => 'slate'],
                        ];
                    @endphp

                    @foreach($statuses as $value => $meta)
                    <label class="cursor-pointer group">
                        <input type="radio" name="status" value="{{ $value }}" class="hidden peer" {{ (old('status', $lead->status ?? 'new') == $value) ? 'checked' : '' }}>
                        <div class="flex flex-col items-center gap-2 p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 transition-all peer-checked:border-{{ $meta['color'] }}-500 peer-checked:bg-{{ $meta['color'] }}-500/5 group-hover:scale-[1.02]">
                            <i class="fa-solid {{ $meta['icon'] }} text-{{ $meta['color'] }}-500 transition-transform group-hover:scale-110"></i>
                            <span class="text-xs font-bold uppercase tracking-tighter {{ (old('status', $lead->status ?? 'new') == $value) ? 'text-'.$meta['color'].'-600' : 'text-slate-500' }} peer-checked:text-{{ $meta['color'] }}-600">
                                {{ $value }}
                            </span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-bold shadow-xl shadow-blue-500/30 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all active:scale-[0.98]">
                    {{ isset($lead) ? 'Apply Changes to Prospect' : 'Launch New Prospect' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

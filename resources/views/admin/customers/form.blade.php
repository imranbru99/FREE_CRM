@extends('layouts.app')
@section('title', isset($customer) ? 'Edit Customer' : 'New Customer')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.customers.index') }}" class="text-slate-400 hover:text-blue-500 text-sm flex items-center gap-2 mb-2">
            <i class="fa-solid fa-arrow-left"></i> Back to list
        </a>
        <h2 class="text-2xl font-bold">{{ isset($customer) ? 'Update Customer Profile' : 'Register New Customer' }}</h2>
    </div>

    <form action="{{ isset($customer) ? route('admin.customers.update', $customer) : route('admin.customers.store') }}" method="POST">
        @csrf
        @if(isset($customer)) @method('PUT') @endif

        <div class="glass-panel rounded-3xl p-8 space-y-6 shadow-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none transition-all" required>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none transition-all" required>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Company</label>
                    <input type="text" name="company" value="{{ old('company', $customer->company ?? '') }}"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Primary Address</label>
                <textarea name="address" rows="3"
                          class="w-full px-4 py-3 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus:ring-2 ring-blue-500/20 outline-none transition-all">{{ old('address', $customer->address ?? '') }}</textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:scale-[1.01] transition-transform">
                    {{ isset($customer) ? 'Save Changes' : 'Create Customer Record' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

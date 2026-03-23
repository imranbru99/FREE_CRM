@extends('layouts.admin')
@section('title', 'Account Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-10">

    <div>
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Settings</h2>
        <p class="text-slate-500 text-sm mt-1">Manage your account preferences and security.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <h3 class="font-bold text-slate-800">Profile Information</h3>
            <p class="text-xs text-slate-500 mt-1">Update your account's profile information and email address.</p>
        </div>

        <div class="lg:col-span-2">
            <form action="{{ route('admin.profile.update') }}" method="POST" class="glass-panel rounded-3xl p-8 shadow-xl space-y-6">
                @csrf @method('PATCH')

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 outline-none transition-all">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="border-slate-100">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <h3 class="font-bold text-slate-800">Update Password</h3>
            <p class="text-xs text-slate-500 mt-1">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <div class="lg:col-span-2">
            <form action="{{ route('admin.profile.password') }}" method="POST" class="glass-panel rounded-3xl p-8 shadow-xl space-y-6">
                @csrf @method('PUT')

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">Current Password</label>
                    <input type="password" name="current_password"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 outline-none transition-all">
                    @error('current_password') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">New Password</label>
                        <input type="password" name="password"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 ring-blue-500/10 outline-none transition-all">
                    </div>
                </div>

                @error('password') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-8 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:opacity-90 transition-all">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

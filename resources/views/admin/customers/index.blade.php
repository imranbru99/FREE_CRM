@extends('layouts.admin')
@section('title', 'Customers')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Customer Directory</h2>
        <p class="text-slate-500 text-sm">Manage your client relationships and contact details.</p>
    </div>
    <a href="{{ route('admin.customers.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium shadow-lg shadow-blue-500/20 transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i> Add Customer
    </a>
</div>

<div class="glass-panel rounded-3xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Client</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Company</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Contact</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($customers as $customer)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                            {{ substr($customer->name, 0, 1) }}
                        </div>
                        <span class="font-semibold">{{ $customer->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-slate-500">{{ $customer->company ?? '—' }}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium">{{ $customer->email }}</div>
                    <div class="text-xs text-slate-400">{{ $customer->phone }}</div>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.customers.edit', $customer) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Delete this customer?')">
                            @csrf @method('DELETE')
                            <button class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $customers->links() }}
    </div>
</div>
@endsection

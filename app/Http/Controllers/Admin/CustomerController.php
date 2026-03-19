<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create() {
        return view('admin.customers.form');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string',
            'company' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
        Customer::create($data);
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer) {
        return view('admin.customers.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string',
            'company' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
        $customer->update($data);
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return back()->with('success', 'Customer deleted.');
    }
}

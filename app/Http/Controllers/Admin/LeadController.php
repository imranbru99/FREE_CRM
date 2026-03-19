<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(10);
        return view('admin.leads.index', compact('leads'));
    }

    public function create()
    {
        return view('admin.leads.form');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'required|string',
            'source' => 'required|string',
            'status' => 'required|in:new,contacted,qualified,lost',
        ]);

        Lead::create($data);
        return redirect()->route('admin.leads.index')->with('success', 'Lead captured successfully.');
    }

    public function edit(Lead $lead)
    {
        return view('admin.leads.form', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'required|string',
            'source' => 'required|string',
            'status' => 'required|in:new,contacted,qualified,lost',
        ]);

        $lead->update($data);
        return redirect()->route('admin.leads.index')->with('success', 'Lead updated.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return back()->with('success', 'Lead removed.');
    }
}

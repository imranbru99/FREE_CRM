<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('customer')->latest()->paginate(10);
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('admin.tasks.form', compact('customers'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pending,in_progress,completed',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $data['user_id'] = auth()->id();
        Task::create($data);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $customers = Customer::orderBy('name')->get();
        return view('admin.tasks.form', compact('task', 'customers'));
    }

    public function update(Request $request, Task $task)
    {

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pending,in_progress,completed',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $task->update($data);
        return redirect()->route('admin.tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task deleted.');
    }
}

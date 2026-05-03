<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        // Search
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $todos = $query->paginate(10)->appends($request->query());
        
        return view('todos.index', compact('todos'));
    }

    public function stats()
{
    // Auth check jate kono error na hoy
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $userTodos = Todo::where('user_id', Auth::id())->get();
    $pendingTodos = $userTodos->where('status', 'pending');

    return response()->json([
        'status' => [
            'pending' => $pendingTodos->count(),
            'completed' => $userTodos->where('status', 'completed')->count(),
        ],
        'priority' => [
            'high' => $pendingTodos->where('priority', 'high')->count(),
            'medium' => $pendingTodos->where('priority', 'medium')->count(),
            'normal' => $pendingTodos->where('priority', 'normal')->count(),
        ],
        'total' => $userTodos->count()
    ]);
}

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'required|in:high,medium,normal',
        ]);

        Auth::user()->todos()->create($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully!');
    }

    public function edit(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,completed',
            'priority' => 'required|in:high,medium,normal',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully!');
    }

    public function toggleStatus(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->update(['status' => $todo->status === 'pending' ? 'completed' : 'pending']);

        return response()->json([
            'success' => true,
            'status' => $todo->fresh()->status
        ]);
    }
}
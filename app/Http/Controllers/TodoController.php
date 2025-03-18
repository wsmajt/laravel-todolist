<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'todos' => Todo::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $request->user()->todos()->create($validated);

        return redirect()->back();
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'completed' => $request->completed
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back();
    }
}

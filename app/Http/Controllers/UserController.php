<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()
                    ->filter(request(['search', 'status']))
                    ->paginate(10)
                    ->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'nullable|string|max:255',
            'position_id' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        DB::transaction(function () use ($validated) {
            $validated['password'] = Hash::make($validated['password']);
            $validated['status'] = $validated['status'] ?? true;

            User::create($validated);
        });

        return redirect()->route('users.index')
                        ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'department_id' => 'nullable|string|max:255',
            'position_id' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully.');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Update user status
     */
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $user->update(['status' => $request->status]);

        $status = $request->status ? 'activated' : 'deactivated';

        //return redirect()->route('users.show', ['id' => $user->id]);
        return view('users.show', compact('user'));

        // return response()->json([
        //     'success' => true,
        //     'message' => "User {$status} successfully.",
        //     'status_badge' => $user->status_badge
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent users from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully.');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        $users = User::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'activate':
                $users->update(['status' => true]);
                $message = 'Selected users activated successfully.';
                break;

            case 'deactivate':
                $users->update(['status' => false]);
                $message = 'Selected users deactivated successfully.';
                break;

            case 'delete':
                // Prevent self-deletion
                $users->where('id', '!=', auth()->id())->delete();
                $message = 'Selected users deleted successfully.';
                break;
        }

        return back()->with('success', $message);
    }
}

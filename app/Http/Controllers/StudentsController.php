<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.students.index', compact('users'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            // Add other validation rules as needed
        ]);
        \Log::info('User before update:', ['user' => $user->toArray()]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // Update other fields as needed
        ]);
        \Log::info('User after update:', ['user' => $user->fresh()->toArray()]);
        return redirect()->route('admin.students.index')->with('success', 'User created successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.students.edit', compact('user'));
    }

    public function destroy(User $user)
    {
    $user->delete();
    return redirect()->route('admin.students.index')->with('success', 'User deleted successfully');
    }

}

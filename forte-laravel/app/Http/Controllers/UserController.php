<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function store(Request $request) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // assign role ke user baru
        $user->assignRole($request->role);

        return back()->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // sync role (hapus role lama, assign role baru)
        $user->syncRoles([$request->role]);

        return back()->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user) {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}

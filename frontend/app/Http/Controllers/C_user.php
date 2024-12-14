<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\M_role;

class C_user extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->get();

        return view('user.V_index_user', compact('users'));
    }

    public function create(Request $request)
    {
        $roles = M_role::orderBy('role_name', 'asc')->get();

        return view('user.V_create_user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id'  => 'required|integer',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Data berhasil ditambah.');
    }

    public function edit(Request $request, User $user)
    {
        $roles = M_role::orderBy('role_name', 'asc')->get();

        return view('user.V_edit_user', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|string|email|max:100|unique:users,email,' . $user->uuid . ',uuid',
            'password' => 'nullable|string|min:6|confirmed',
            'role_id'  => 'required|integer',
        ]);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data berhasil dihapus.');
    }

    public function profile(Request $request, string $uuid)
    {
        $profile = User::where('uuid', $uuid)->first();
        return view('user.V_edit_profile', compact('profile'));
    }

    public function profile_update(Request $request, string $uuid)
    {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|string|email|max:100|unique:users,email,' . $uuid . ',uuid',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $profile = User::where('uuid', $uuid)->first();

        if (!$profile) {
            return redirect()->route('profile', $uuid)->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $profile->update($data);

        return redirect()->route('profile', $uuid)->with('success', 'Data berhasil diperbarui.');
    }
}

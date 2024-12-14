<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\M_role;

class C_role extends Controller
{
    public function index()
    {
        $roles = M_role::orderBy('id', 'desc')->get();

        return view('role.V_index_role', compact('roles'));
    }

    public function create(Request $request)
    {
        return view('role.V_create_role');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name'     => 'required|string|max:50',
        ]);

        $data = $request->all();
        M_role::create($data);

        return redirect()->route('roles.index')->with('success', 'Data berhasil ditambah.');
    }

    public function edit(Request $request, M_role $role)
    {
        return view('role.V_edit_role', compact('role'));
    }

    public function update(Request $request, M_role $role)
    {
        $request->validate([
            'role_name'     => 'required|string|max:50',
        ]);

        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = $request->all();
        $role->update($data);

        return redirect()->route('roles.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(M_role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * LIST USER
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Data Pengguna'
        ]);
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.users.create', [
            'title' => 'Tambah Pengguna'
        ]);
    }

    /**
     * SIMPAN USER
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'role'      => 'required|in:admin,user',
            'is_active' => 'required|in:0,1',
        ]);

        User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
            'is_active' => (int) $validated['is_active'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * DETAIL USER
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user'  => $user,
            'title' => 'Detail Pengguna'
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user'  => $user,
            'title' => 'Edit Pengguna'
        ]);
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|in:admin,user',
            'is_active' => 'required|in:0,1',
            'password'  => 'nullable|min:6',
        ]);

        $data = [
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'role'      => $validated['role'],
            'is_active' => (int) $validated['is_active'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * HAPUS USER
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}

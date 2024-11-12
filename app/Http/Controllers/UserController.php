<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        //Validasi data dari request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        if ($request->has('roles')) {
            // ambil nama role berdasarkan ID yang diberikan
            $roles = Role::whereIn('id', $request->roles)->pluck('name');
            $user->syncRoles($roles); // Tetapkan role pada pengguna
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id) 
    {
        $user = User::with('roles')->findOrFail($id);
    
        // Cek jika request datang dari AJAX
        if (request()->ajax()) {
            return response()->json($user);
        }
    
        // Jika bukan AJAX, kembalikan view
        return view('users.show', compact('user'));
    }
    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // ambil semua peran dari spatie
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        //Validasi data dari request 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:user,admin',
        ]);

        //Ambil pengguna berdasarkan ID dan perbarui informasinya
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        //periksa apakah password baru diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->syncRoles($request->role);
        $user->save();

        //redirect kembali ke halaman detail pengguna dengan pesan sukses
        return redirect()->route('users.show', $id)->with('success', 'user update successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        //Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}

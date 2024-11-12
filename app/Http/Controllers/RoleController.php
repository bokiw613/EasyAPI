<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array'
        ]);

        $role = Role::create(['name' => $request->name]);

            // Memproses izin-izin yang dipilih
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            foreach ($permissions as $permissionName) {
                // Cari atau buat izin baru
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                
                // Berikan izin tersebut kepada role
                $role->givePermissionTo($permission);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::with('permissions')->find($id); // Pastikan juga mengembalikan permissions
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        
        return response()->json($role); // Kembalikan data role sebagai JSON
    }
    
    public function edit($id)
    {
        $role = Role::findorFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findorFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        //update nama role
        $role->name = $request->name;
        $role->save();

        // Sinkronisasi izin-izin yang dipilih
    if ($request->has('permissions')) {
        //pastikan bahwa permissions ada di database dan gunakan guard yang sesuai
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
        $role->syncPermissions($permissions);
    }
        
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}

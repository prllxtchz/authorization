<?php

namespace PrllxTchz\Authorization\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Modules\RolesAndPermissions\Facades\RolesAndPermissionsFacade;
use Modules\RolesAndPermissions\Http\Requests\AddUserRoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('VIEW USER_ROLE'))
            throw new UnauthorizedException();

        $roles = Role::all();//Get all roles

        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cannot('CREATE USER_ROLE'))
            throw new UnauthorizedException();

        $permissions = Permission::all();

        $grouped_permissions = RolesAndPermissionsFacade::getGroupedPermissions($permissions);

        return view('roles.create', ['permissions' => $grouped_permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddUserRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRoleRequest $request)
    {
        try {
            if (Auth::user()->cannot('CREATE USER_ROLE'))
                throw new UnauthorizedException();

            $role = Role::create(['name' => $request->role_name]);

            $requested_permissions = $request->role_permissions;

            foreach ($requested_permissions as $permission) {
                $permission = (Permission::findById($permission))->name;
                $role->givePermissionTo($permission);
            }

            return redirect('roles')->with('status', 'Role Created');

        } catch (RoleAlreadyExists $e) {
            return back()->withError('Role already exists')->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->cannot('MODIFY USER_ROLE'))
            throw new UnauthorizedException();

        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $grouped_permissions = RolesAndPermissionsFacade::getGroupedPermissions($permissions);

        $role_permissions = $role->permissions->toArray();

        return view('roles.edit', compact('role', 'role_permissions', 'grouped_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            if (Auth::user()->cannot('MODIFY USER_ROLE'))
                throw new UnauthorizedException();

            $role = Role::find($id);
            $role->name = $request->role_name;
            $role->save();

            $new_role_permissions = Permission::whereIn('id', $request->role_permissions)->pluck('name')->all();

            $role->syncPermissions($new_role_permissions);

            return redirect('roles')->with('status', 'Role Updated');

        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Auth::user()->cannot('DELETE USER_ROLE'))
                throw new UnauthorizedException();

            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.index')
                ->with('status',
                    'Role deleted!');

        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}

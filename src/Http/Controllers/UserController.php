<?php

namespace Prllxtchz\Authorization\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('VIEW USER'))
            throw new UnauthorizedException();

        $users = User::all();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cannot('CREATE USER'))
            throw new UnauthorizedException();
        $roles = Role::all();

        return view('users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (Auth::user()->cannot('CREATE USER'))
                throw new UnauthorizedException();

            $user = User::create([
                'name' => $request->nick_name,
                'email' => $request->email,
                'password' => bcrypt('@parallax<>')
            ]);

            $role_names = Role::whereIn('id', $request->roles)->pluck('name')->all();

            $user->assignRole($role_names);

            return redirect('users')->with('status', 'User Created');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->cannot('MODIFY USER'))
            throw new UnauthorizedException();

        $user = User::findOrFail($id);
        $roles = Role::all();

        $user_roles = $user->roles()->get()->toArray();

        foreach ($roles as &$role) {
            if (array_search($role->id, array_column($user_roles, 'id')) !== false) {
                $role['selected'] = true;
            }
        }

        return view('users.edit', compact('user', 'roles'));
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

            if (Auth::user()->cannot('MODIFY USER'))
                throw new UnauthorizedException();

            $user = User::find($id);
            $user->name = $request->nick_name;
            $user->email = $request->email;
            $user->save();

            $new_roles = Role::whereIn('id', $request->roles)->pluck('name')->all();

            $user->syncRoles($new_roles);

            return redirect('users')->with('status', 'User Updated');

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
            if (Auth::user()->cannot('DELETE USER'))
                throw new UnauthorizedException();

            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')
                ->with('status',
                    'User deleted!');

        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}

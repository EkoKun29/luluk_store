<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with('roles')
            ->when(request()->filled('q'), function (Builder $query) {
                $q = request()->input('q');
                return $query->where('name', 'LIKE', `%$q%`)
                    ->orWhere('email', 'LIKE', `%$q%`);
            })->when(request()->filled('role') && in_array(request()->input('role'), ['admin', 'user']), function (Builder $query) {
                return $query->role(request()->input('role'));
            })
            ->get();
        $roles = Role::all();
        return view('management.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('management.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except(['role', 'password']);
            $data['password'] = Hash::make($request->password);

            $user = User::query()->create($data);
            $user->assignRole($request->role);

            DB::commit();
            return to_route('users.index');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('management.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except(['role', 'password']);
            if($request->filled('password')){
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);
            $user->syncRoles($request->role);

            DB::commit();
            return to_route('users.index');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index');
    }
}

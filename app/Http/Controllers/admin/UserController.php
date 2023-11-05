<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('content.user.index', [
            'users'     => User::latest()->get(),
        ]);
    }

    public function create()
    {
        $roles = Role::where('nama_role', '!=', 'superadmin')->pluck('nama_role', 'role_id');
        return view('content.user.create', ['role' => $roles]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required'],
            'email'      => ['required', 'email:dns', 'unique:users'],
            'password'      => ['required'],
            'confirm-password'      => ['required', 'same:password']
        ]);

        // $data['password'] = Hash::make($request->password);
        // $data['verified_at'] = now();
        // $data['remember_token'] = Str::random(60);

        // User::create($data);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->remember_token = Str::random(60);
        $user->email_verified_at = now();
        $user->save();

        return redirect('user')->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function edit(User $user)
    {
        return view('content.user.edit', [
            'user'          => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => ['required'],
            'email'      => $request->email !== $user->email ? ['email:dns', 'unique:users'] : ['email:dns'],
            'password'   => ['']
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $data['password'] = $request->password ? $data['password'] : $user->password;

        User::where('id', $user->id)->update($data);

        return redirect('user')->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return back()->with('msg', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    }
}

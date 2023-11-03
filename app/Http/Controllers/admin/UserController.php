<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users', [
            'users'     => User::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.user_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required'],
            'email'      => ['email:dns','unique:users'],
            'password'      => ['required', 'min:4', 'max:255']
        ]);

        $data['password'] = Hash::make($request->password);
        $data['verified_at'] = now();
        $data['remember_token'] = Str::random(60);

        User::create($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function edit(User $user)
    {
        return view('admin.user_edit', [
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

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return back()->with('msg', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    }
}
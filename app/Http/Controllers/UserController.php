<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUser()
    {
        $users = User::where('role', 'user')->get();

        return view('admin/data_pelanggan', ['users' => $users, 'title' => 'Data Pelanggan']);
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->email = $request->post('email');
        $user->password = Hash::make($request->post('password'));
        $user->save();

        return redirect()->back()->with('success', 'Tambah User Berhasil');
    }

    public function editUser(Request $request)
    {
        $id = $request->post('id');
        $user = User::find($id);
        $user->email = $request->post('email');
        $user->password = Hash::make($request->post('password'));
        $user->save();

        return redirect()->back()->with('success', 'Edit User Berhasil');
    }

    public function deleteUser(Request $request)
    {
        $id = $request->post('id');
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'Hapus User Berhasil');
    }
}

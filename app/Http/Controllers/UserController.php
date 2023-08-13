<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();


        return view('user', [
            'user' => $data
        ]);
    }

    public function tambahUser(Request $request)
    {
        User::create([
            'name' => $request->nama_user,
            'email' => $request->email_user,
            'role' => $request->role_user,
            'password' => $request->password_user
        ]);

        return redirect("/user");
    }

    public function editUser($kode)
    {
        $data = User::where('id', $kode)->first();
        return response()->json($data);
    }

    public function updateUser(Request $request)
    {
        $dataUser = User::where('id', $request->id_user)->first();
        $dataUser->update([
            'name' => $request->nama_user_edit,
            'email' => $request->email_user_edit,
            'role' => $request->role_user_edit,
            'password' => $request->password_user_edit
        ]);

        return redirect("/user");
    }

    public function destroy($kode)
    {
        $data = User::all();

        $delete = $data->where('id', $kode)->first();
        $delete->delete();
    }
}

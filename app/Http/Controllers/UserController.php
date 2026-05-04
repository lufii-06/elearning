<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(User::all());
    }
    // Tambah User
    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'User berhasil DITAMBAH!', 'data' => $user]);
    }

    public function update(Request $request, String $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User tidak ketemu'], 404);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'User berhasil UPDATE!', 'data' => $user]);
    }

    // Hapus User
    public function destroy(String $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User tidak ketemu'], 404);

        $user->delete();
        return response()->json(['message' => 'User berhasil dihapus']);
    }
}

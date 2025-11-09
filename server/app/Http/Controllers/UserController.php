<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'phone' => 'required',
            'preferred_language' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
            'hash_id' => Hashids::encode($user->id),
        ]);
    }

    public function show($id)
    {
    // Decode ID yang di-hash
    $decoded = Hashids::decode($id);

    // Jika hasil decode kosong, berarti hash tidak valid
    if (empty($decoded)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or corrupted ID.'
        ], 400);
    }

    // Ambil ID asli dari hasil decode
    $userId = $decoded[0];

    // Cari user berdasarkan ID asli
    $user = User::find($userId);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }

    // Kembalikan data user
    return response()->json([
        'success' => true,
        'data' => $user
    ]); 
    }

    public function update(Request $request, $hashid)
    {
        $decoded = Hashids::decode($hashid);
        if (empty($decoded)) {
            return response()->json(['error' => 'Invalid ID'], 404);
        }
        $user = User::findOrFail($decoded[0]);
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($hashid)
    {
        $decoded = Hashids::decode($hashid);
        if (empty($decoded)) {
            return response()->json(['error' => 'Invalid ID'], 404);
        }
        User::destroy($decoded[0]);
        return response()->json(['message' => 'User deleted successfully']);
    }
}

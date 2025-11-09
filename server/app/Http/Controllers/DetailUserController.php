<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailUser;

class DetailUserController extends Controller
{
    public function index()
    {
        return response()->json(DetailUser::with('user')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'foto_wajah' => 'nullable|string',
            'nomor_darurat' => 'nullable|string',
        ]);

        $data = DetailUser::create($validated);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = DetailUser::with('user')->findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = DetailUser::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        DetailUser::destroy($id);
        return response()->json(['message' => 'Detail user deleted']);
    }
}

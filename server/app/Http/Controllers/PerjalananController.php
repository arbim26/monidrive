<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perjalanan;

class PerjalananController extends Controller
{
    public function index()
    {
        return response()->json(Perjalanan::with('detailPerjalanan')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'lokasi_awal' => 'required|string',
            'lokasi_tujuan' => 'required|string',
            'durasi' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $data = Perjalanan::create($validated);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = Perjalanan::with('detailPerjalanan')->findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Perjalanan::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        Perjalanan::destroy($id);
        return response()->json(['message' => 'Perjalanan deleted']);
    }
}

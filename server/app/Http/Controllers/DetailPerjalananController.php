<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPerjalanan;

class DetailPerjalananController extends Controller
{
    public function index()
    {
        return response()->json(DetailPerjalanan::with('perjalanan')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'perjalanan_id' => 'required|exists:perjalanans,id',
            'lokasi' => 'required|string',
            'kecepatan' => 'nullable|numeric',
            'status_mata' => 'nullable|string',
            'waktu' => 'required|date',
        ]);

        $data = DetailPerjalanan::create($validated);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = DetailPerjalanan::with('perjalanan')->findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = DetailPerjalanan::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        DetailPerjalanan::destroy($id);
        return response()->json(['message' => 'Detail perjalanan deleted']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeringatanPengguna;

class PeringatanPenggunaController extends Controller
{
    public function index()
    {
        return response()->json(PeringatanPengguna::with('detailPerjalanan')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'detail_perjalanan_id' => 'required|exists:detail_perjalanans,id',
            'jenis_peringatan' => 'required|string',
            'waktu_peringatan' => 'required|date',
            'status_tindakan' => 'nullable|string',
        ]);

        $data = PeringatanPengguna::create($validated);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = PeringatanPengguna::with('detailPerjalanan')->findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = PeringatanPengguna::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        PeringatanPengguna::destroy($id);
        return response()->json(['message' => 'Peringatan deleted']);
    }
}

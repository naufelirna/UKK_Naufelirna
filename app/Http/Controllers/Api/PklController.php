<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PklController extends Controller
{
    public function index()
    {
        $pkls = Pkl::with(['siswa', 'guru', 'industri'])->get();
        return response()->json($pkls);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $existing = Pkl::where('siswa_id', $request->siswa_id)->first();
        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah menambah data PKL sebelumnya'
            ], 422);
        }

        $pkl = Pkl::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'industri_id' => $request->industri_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_pkl' => 'true'
        ]);

        $siswa = Siswa::find($request->siswa_id);
        $siswa->update(['status_pkl' => 'true']);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $pkl
        ], 201);
    }

    public function show($id)
    {
        $pkl = Pkl::with(['siswa', 'guru', 'industri'])->find($id);
        
        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        
        return response()->json($pkl);
    }

    public function update(Request $request, $id)
    {
        $pkl = Pkl::find($id);
        
        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
        
        $pkl->update($request->all());
        
        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $pkl
        ]);
    }

    public function destroy($id)
    {
        $pkl = Pkl::find($id);
        
        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        
        $pkl->delete();
        
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
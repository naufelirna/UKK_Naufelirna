<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class PklController extends Controller
{
    /**
     * Display a listing of the resource (khusus siswa yang login).
     */
    public function index()
    {
        // Ambil email user yang login
        $email = Auth::user()->email;

        // Cari siswa berdasarkan email
        $siswa = Siswa::where('email', $email)->first();

        // Jika siswa ditemukan, ambil data PKL miliknya
        if ($siswa) {
            $pkl = Pkl::where('siswa_id', $siswa->id)->get();
            return response()->json($pkl, 200);
        }

        return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
    }

    /**
     * Store a newly created resource in storage (hanya bisa simpan untuk dirinya sendiri).
     */
    public function store(Request $request)
    {
        $email = Auth::user()->email;
        $siswa = Siswa::where('email', $email)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        // Validasi
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Cek apakah siswa sudah punya data PKL
        if ($siswa->status_pkl) {
            return response()->json(['message' => 'Siswa ini sudah memiliki data PKL'], 409);
        }

        $pkl = new Pkl();
        $pkl->siswa_id = $siswa->id; // pakai ID siswa dari login
        $pkl->guru_id = $request->guru_id;
        $pkl->industri_id = $request->industri_id;
        $pkl->tanggal_mulai = $request->tanggal_mulai;
        $pkl->tanggal_selesai = $request->tanggal_selesai;
        $pkl->save();

        // Update status siswa
        $siswa->update(['status_pkl' => true]);

        return response()->json($pkl, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $email = Auth::user()->email;
        $siswa = Siswa::where('email', $email)->first();

        $pkl = Pkl::where('id', $id)->where('siswa_id', $siswa->id)->first();

        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan atau bukan milik Anda'], 404);
        }

        return response()->json($pkl, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $email = Auth::user()->email;
        $siswa = Siswa::where('email', $email)->first();

        $pkl = Pkl::where('id', $id)->where('siswa_id', $siswa->id)->first();

        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan atau bukan milik Anda'], 404);
        }

        $request->validate([
            'guru_id' => 'sometimes|required|exists:gurus,id',
            'industri_id' => 'sometimes|required|exists:industris,id',
            'tanggal_mulai' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|required|date|after_or_equal:tanggal_mulai',
        ]);

        $pkl->guru_id = $request->guru_id ?? $pkl->guru_id;
        $pkl->industri_id = $request->industri_id ?? $pkl->industri_id;
        $pkl->tanggal_mulai = $request->tanggal_mulai ?? $pkl->tanggal_mulai;
        $pkl->tanggal_selesai = $request->tanggal_selesai ?? $pkl->tanggal_selesai;
        $pkl->save();

        return response()->json($pkl, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $email = Auth::user()->email;
        $siswa = Siswa::where('email', $email)->first();

        $pkl = Pkl::where('id', $id)->where('siswa_id', $siswa->id)->first();

        if (!$pkl) {
            return response()->json(['message' => 'Data tidak ditemukan atau bukan milik Anda'], 404);
        }

        $pkl->delete();

        // Reset status PKL siswa
        $siswa->update(['status_pkl' => false]);

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class APIGuruontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::get();
        return response()->json($guru, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guru = new Guru();
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->alamat;
        $guru->kontak = $request->kontak;
        $guru->email = $request->email;
        $guru->save();
        return response()->json($guru, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::find($id);
        return response()->json($guru, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->alamat;
        $guru->kontak = $request->kontak;
        $guru->email = $request->email;
        $guru->save();
        return response()->json($guru, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(["message"=>"Deleted"], 200);
    }
}

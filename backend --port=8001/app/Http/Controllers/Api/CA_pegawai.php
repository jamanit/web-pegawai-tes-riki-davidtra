<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\M_pegawai;

class CA_pegawai extends Controller
{
    public function index()
    {
        $pegawai = M_pegawai::with('jabatan')->get();
        return response()->json([
            'success' => true,
            'data'    => $pegawai,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_pegawai' => 'required|string|max:50',
                'tanggal_lahir'    => 'required|string',
                'tanggal_masuk'    => 'required|string',
                'id_jabatan'   => 'required|integer|max:11',
            ]);

            $nip   = substr(date('Y', strtotime($validated['tanggal_masuk'])), 2) . date('m', strtotime($validated['tanggal_masuk'])) . substr(date('Y', strtotime($validated['tanggal_lahir'])), 2) . rand(0000, 9999);
            $pegawai = M_pegawai::create([
                'nip'           => $nip,
                'nama_pegawai'  => $validated['nama_pegawai'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'id_jabatan'    => $validated['id_jabatan'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambah.',
                'data'    => $pegawai,
            ], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show(M_pegawai $pegawai)
    {
        return response()->json([
            'success' => true,
            'data'    => $pegawai,
        ], Response::HTTP_OK);
    }

    public function update(Request $request, M_pegawai $pegawai)
    {
        try {
            $validated = $request->validate([
                'nama_pegawai' => 'required|string|max:50',
                'tanggal_lahir'    => 'required|string',
                'tanggal_masuk'    => 'required|string',
                'id_jabatan'   => 'required|integer|max:11',
            ]);

            $nip   = substr(date('Y', strtotime($validated['tanggal_masuk'])), 2) . date('m', strtotime($validated['tanggal_masuk'])) . substr(date('Y', strtotime($validated['tanggal_lahir'])), 2) . rand(0000, 9999);
            $pegawai->update([
                'nip'           => $nip,
                'nama_pegawai'  => $validated['nama_pegawai'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'id_jabatan'    => $validated['id_jabatan'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'data'    => $pegawai,
            ], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(M_pegawai $pegawai)
    {
        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ], Response::HTTP_OK);
    }
}

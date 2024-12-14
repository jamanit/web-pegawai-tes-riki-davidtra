<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class C_pegawai extends Controller
{
    public function index()
    {
        $pegawai_response = Http::get(env('API_URL') . '/pegawai');

        if ($pegawai_response->successful()) {
            $pegawai = collect($pegawai_response->json()['data'])->map(function ($item) {
                $item['created_at'] = $item['updated_at'] = \Carbon\Carbon::parse($item['created_at'])->format('Y/m/d H:i:s');
                if (isset($item['jabatan'])) {
                    $item['jabatan'] = (object) $item['jabatan'];
                }
                return (object) $item;
            });

            $pegawai = $pegawai->sortByDesc('id');

            return view('pegawai.V_index_pegawai', compact('pegawai'));
        } else {
            return redirect()->back()
                ->with('error', $pegawai_response->json()['message'] ?? 'Data gagal diambil.');
        }
    }
}

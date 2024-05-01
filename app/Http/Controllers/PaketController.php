<?php

namespace App\Http\Controllers;

use App\Models\Paketkuota;
use App\Models\SatuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paketkuota::get();
        $satuans = SatuanModel::where('status', 'Aktif')->get();
        return view('paket.index', compact('pakets', 'satuans'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'cabang' => 'required',
        ])->validate();

        Paketkuota::create([
            'nama' => $request->nama,
            'berat' => $request->berat,
            'harga' => $request->harga,
            'satuan_id' => $request->satuan,
            'cabang' => $request->cabang,
            'status' => 'Aktif',
        ]);

        return redirect()->route('paket')->with('success', 'Sukses tambah data');
    }

    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'cabang' => 'required',
        ])->validate();

        $satuan = Paketkuota::findOrFail($id);

        if ($satuan) {
            $satuan->update([
                'nama' => $request->nama,
                'berat' => $request->berat,
                'harga' => $request->harga,
                'satuan_id' => $request->satuan,
                'cabang' => $request->cabang,
            ],[
                'nama.required' => 'Nama harus diisi.',
                'berat.required' => 'berat harus diisi.',
                'berat.numeric' => 'berat harus angka.',
                'nama.required' => 'Nama harus diisi.',
            ]);
        }
        return redirect()->route('paket')->with('success', 'Berhasil Edit Data');
    }


    public function aktion(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'status' => 'required',
        ])->validate();

        $satuan = Paketkuota::findOrFail($id);

        if ($satuan) {
            $satuan->update([
                'status' => $request->status,
            ]);
        }

        return redirect()->route('paket')->with('success', 'Berhasil Melakukan Aktion');
    }
}

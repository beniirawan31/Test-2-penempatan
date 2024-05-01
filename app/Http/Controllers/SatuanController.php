<?php

namespace App\Http\Controllers;

use App\Models\SatuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = SatuanModel::get();
        return view('satuan.index', compact('satuans'));
    }

    public function create(){
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'satuan' => 'required',
            'deskripsi' => 'required',
        ])->validate();

        SatuanModel::create([
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'status' => 'Aktif',
        ]);

        return redirect()->route('satuan')->with('success', 'Sukses tambah data');
    }

    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'satuan' => 'required',
            'deskripsi' => 'required',
        ])->validate();

        $satuan = SatuanModel::findOrFail($id);

        if ($satuan) {
            $satuan->update([
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        return redirect()->route('satuan')->with('success', 'Sukses update data');
    }

    public function aktion(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'status' => 'required',
        ])->validate();

        $satuan = SatuanModel::findOrFail($id);

        if ($satuan) {
            $satuan->update([
                'status' => $request->status,
            ]);
        }

        return redirect()->route('satuan')->with('success', 'Sukses update data');
    }

}

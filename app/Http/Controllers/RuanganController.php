<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pencarian = $request->query('cari');
        if (!empty($pencarian)){
            $data = Ruangan::where('nama_ruangan', 'LIKE', '%'.$pencarian.'%')->paginate(10);
        }else{
        if ($request->id == 10) {

            $data = Ruangan::orderBy('nama_ruangan')->paginate(10);
            return view('ruangan.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 25){
            $data = Ruangan::orderBy('nama_ruangan')->paginate(25);
            return view('ruangan.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 50){
            $data = Ruangan::orderBy('nama_ruangan')->paginate(50);
            return view('ruangan.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 100){
            $data = Ruangan::orderBy('nama_ruangan')->paginate(100);
            return view('ruangan.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else {
            $data = Ruangan::orderBy('nama_ruangan')->paginate(10);
            return view('ruangan.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        }
    }
    return view('ruangan.data')->with([
        'data' => $data,
        'cari' => $pencarian
    ]);
    }
    public function create()
    {
        return 'create';
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'unique:tb_ruangans'
        ]);
        $ruang = new Ruangan();
        $ruang->nama_ruangan = $request->get('nama_ruangan');
        $ruang->save();
        return redirect('ruangan')->with(['berhasil' => 'Berhasil']);
    }

    public function editruangan($id)
    {
        $data = Ruangan::all()->where('id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|unique:tb_ruangans',
        ],[
            'nama_ruangan.required' => 'Tidak boleh kosong',
        ]);
        $id = $request->id;
        Ruangan::where('id', $id)
        ->update([
            'nama_ruangan' => $request->nama_ruangan,
        ]);
        return redirect('ruangan')->with(['ubah' => 'Berhasil']);
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);
    }
}

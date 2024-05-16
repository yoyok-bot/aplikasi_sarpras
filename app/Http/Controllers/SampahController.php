<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hapusbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SampahController extends Controller
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
    public function index()
    {
        $data = Hapusbarang::all();
        return view('sampah.data', compact('data'));
    }

    public function sampah() {
        $data = Hapusbarang::all();
        return DataTables::of(DB::table('tb_barangrusaks')
        ->join('tb_barangs','tb_barangrusaks.id_barang','=','tb_barangs.id')
        ->select('tb_barangrusaks.id','tb_barangrusaks.jumlahrusak','tb_barangrusaks.status','tb_barangrusaks.updated_at','tb_barangrusaks.created_at','tb_barangrusaks.id_barang','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran')->get())
        ->addColumn('action',  function ($data) {
            $restore = '<a href="' . route('sampah.restore', $data->id) . '" class="btn btn-warning" style="font-size: 15px"><i class="fa fa-undo"></i></a>';
            $del = '<a href="#" data-id="' . $data->id . '" class="btn btn-danger hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i></a>';
            $selesai = 'Barang sudah masuk aset penghapusan';
            if($data->status == 'Sementara'){
                return $restore . '&nbsp' . '&nbsp' . $del;
            }else{
                return $selesai;
            }
        })
        ->make(true);
    }

    public function restore($id)
    {
        $restore= Hapusbarang::where('id', $id)->first();
        $restore1 = $restore->status;
        if($restore1 == 'Sementara'){
            $restore2 = $restore->id_barang;
            $data = Barang::where('id', $restore2)->first();
            $id1 = $data->id;
            if($restore2 == $id1){
                $jumlah = $restore->jumlahrusak;
                $jumlah2 = $data->jumlah;
                $total = $jumlah2 + $jumlah;
                if($total >= 1){
                Barang::where('id', $id1)
                ->update([
                    'jumlah' => $total,
                    'status' => 'Ada',
                ]);
                Hapusbarang::where('id', $id)
                ->update([
                    'status' => 'Permanen',
                ]);
                }
                return redirect('sampah');
            }
            return redirect('sampah');
        }
        return redirect('sampah');
    }

    public function destroy($id)
    {
        Hapusbarang::where('id', $id)
        ->update([
            'status' => 'Permanen',
        ]);
    }
}

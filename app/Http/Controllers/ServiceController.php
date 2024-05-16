<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Servicebarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
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
        $data = Servicebarang::all();
        return view('service.data', compact('data'));
    }

    public function service() {
        $data = Servicebarang::all();
        return DataTables::of(DB::table('tb_barangperbaikans')
        ->join('tb_barangs','tb_barangperbaikans.id_barang','=','tb_barangs.id')
        ->select('tb_barangperbaikans.id','tb_barangperbaikans.jumlahperbaikan','tb_barangperbaikans.status','tb_barangperbaikans.keterangan','tb_barangperbaikans.updated_at','tb_barangperbaikans.created_at','tb_barangperbaikans.id_barang','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran')->get())
        ->addColumn('action',  function ($data) {
            $restore = '<a href="' . route('service.restore', $data->id) . '" class="btn btn-warning" style="font-size: 15px"><i class="fa fa-undo"></i></a>';
            $selesai = 'Selesai pemeliharaan';
            $service = 'Masih dalam pemeliharaan';
            if($data->status == 'Proses'){
                if(Gate::allows('CRUD ADMIN')){
                    return $restore;
                }
                return $service;
            }else{
                return $selesai;
            }
        })
        ->make(true);
    }

    public function restore($id)
    {
        $restore= Servicebarang::where('id', $id)->first();
        $restore1 = $restore->status;
        if($restore1 == 'Proses'){
            $restore2 = $restore->id_barang;
            $data = Barang::where('id', $restore2)->first();
            $id1 = $data->id;
            if($restore2 == $id1){
                $jumlah = $restore->jumlahperbaikan;
                $jumlah2 = $data->jumlah;
                $total = $jumlah2 + $jumlah;
                if($total >= 1){
                Barang::where('id', $id1)
                ->update([
                    'jumlah' => $total,
                    'status' => 'Ada',
                ]);
                Servicebarang::where('id', $id)
                ->update([
                    'status' => 'Selesai',
                ]);
                }
                return redirect('service');
            }
            return redirect('service');
        }
        return redirect('service');
    }

}

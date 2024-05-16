<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hapusbarang;
use App\Models\Ruangan;
use App\Models\Servicebarang;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use PDF;

class BarangController extends Controller
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
        $data = Barang::all();
        $data1 = Ruangan::all();
        return view('barang.data', compact('data','data1'));
    }

    public function table() {
        $data = Barang::all();
        return Datatables::of(DB::table('tb_barangs')
        ->join('tb_ruangans','tb_barangs.id_ruangan','=','tb_ruangans.id')
        ->select('tb_ruangans.nama_ruangan','tb_barangs.id','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran'
        ,'tb_barangs.status')->where('status','Ada')->get())
        ->addColumn('action',  function ($data) {
            $show = '<a href="#" data-toggle="modal" data="' . $data->id . '" class="btn btn-primary show-data-barang" data-target="#showbarang" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
            $edit = '<a href="#" data-editsatu="' . $data->id . '" class="btn btn-success editbarangsatu" data-target="#editbarangsatu" style="font-size: 15px"><i class="fa fa-edit"></i></a>';
            $service = '<a href="#" data-service="' . $data->id . '" class="btn btn-warning servicebarang" data-target="#servicebarang" style="font-size: 15px"><i class="fa fa-wrench"></i></a>';
            $del = '<a href="#" data-input="' . $data->id . '" class="btn btn-danger inputbarang" data-target="#inputbarang" style="font-size: 15px"><i class="fa fa-trash"></i></a>';
            $cetak = '<a href="' . route('barang.pdf', $data->id) . '" class="btn btn-default" style="font-size: 15px" target="_blank"><i class="fa fa-print" ></a>';
            if(Gate::allows('CRUD ADMIN')){
                return $show . '&nbsp' .  '&nbsp' . $edit . '&nbsp' . '&nbsp' . $service . '&nbsp' . '&nbsp' .$del . '&nbsp' . '&nbsp' . $cetak;
            }else{
                return $show;
            }
        })
        ->make(true);
    }
    public function showbarang($id)
    {
        $data = DB::table('tb_barangs')
        ->join('tb_ruangans','tb_barangs.id_ruangan','=','tb_ruangans.id')
        ->select('tb_ruangans.id','tb_ruangans.nama_ruangan','tb_barangs.id','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran')
        ->where('tb_barangs.id',$id)->first();
            return response()->json($data);
    }

    public function input($id)
    {
        $data = Barang::all()->where('id',$id)->first();
        return response()->json($data);
    }

    public function service($id)
    {
        $data = Barang::all()->where('id',$id)->first();
        return response()->json($data);
    }

    public function hapus(Request $request)
    {
            $id1 = $request->id;
            $data = Barang::find($id1);
            $jumlah1 = $data->jumlah;
            $jumlah2 = $request->input;
            $total = $jumlah1 - $jumlah2;
            if($total <= 0){
                if($jumlah2 <= $jumlah1){
                    $data->update([
                        'jumlah' => $total,
                        'status' => 'Kosong',
                    ]);
                    $guru = Hapusbarang::create([
                        'jumlahrusak' => $jumlah2,
                        'status' => 'Sementara',
                        'id_barang' => $id1,
                    ]);
                    }
            return redirect('barang');
        }else{
            $data->update([
                'jumlah' => $total,
            ]);
            $guru = Hapusbarang::create([
                'jumlahrusak' => $jumlah2,
                'status' => 'Sementara',
                'id_barang' => $id1,
            ]);
        }
        return redirect('barang');
    }

    public function proses(Request $request)
    {
        $id1 = $request->id;
        $data = Barang::find($id1);
        $barang1 = $data->nama_barang;
        $jumlah1 = $data->jumlah;
        $jumlah2 = $request->input;
        $total = $jumlah1 - $jumlah2;
        if($total <= 0){
            if($jumlah2 <= $jumlah1){
                $data->update([
                    'jumlah' => $total,
                    'status' => 'Kosong',
                ]);
                $guru = Servicebarang::create([
                    'jumlahperbaikan' => $jumlah2,
                    'status' => 'Proses',
                    'keterangan' => $request->keterangan,
                    'id_barang' => $id1,
                ]);
                }
        return redirect('barang')->with(['service' => $jumlah2, $barang1]);
    }else{
        $data->update([
            'jumlah' => $total,
        ]);
        $guru = Servicebarang::create([
            'jumlahperbaikan' => $jumlah2,
            'status' => 'Proses',
            'keterangan' => $request->keterangan,
            'id_barang' => $id1,
        ]);
    }
    return redirect('barang')->with(['service' => $jumlah2, $barang1]);
    }


    public function editbanyak(Request $request)
    {
        $request->validate([
            'checked' => 'required',
        ],[
            'checked.required' => 'Tidak ada yang dipilih',
        ]);
        $id1 = $request->checked;
        for($i=1; $i<=count($id1); $i++){
            $id = $request->checked;
            $data = Barang::all()->whereIn('id',$id);
            $data1 = Ruangan::all();
            }
            return view('barang.banyak', compact('data','data1'));
    }

    public function editbarang($id)
    {
        $data = DB::table('tb_barangs')
        ->join('tb_ruangans','tb_barangs.id_ruangan','=','tb_ruangans.id')
        ->select('tb_ruangans.id','tb_ruangans.nama_ruangan','tb_barangs.id','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran'
        ,'tb_barangs.id_ruangan')
        ->where('tb_barangs.id',$id)->first();
            return response()->json($data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $total = count($request->id);
        for($i=0; $i<count($request->id); $i++){
            $id1 = $request->id[$i];
            $data =Barang::find($id1);
            $data->update([
                'kd_barang'=>$request->kd[$i],
                'no_urut' =>$request->urut[$i],
                'nama_barang' =>$request->nama_barang[$i],
                'merk' =>$request->merk[$i],
                'tahun_perolehan' =>$request->tahun[$i],
                'jumlah' =>$request->jumlah[$i],
                'anggaran' =>$request->anggaran[$i],
                'id_ruangan' =>$request->ruangan[$i],
            ]);
        }
        return redirect('barang')->with(['ubah' => $total]);
    }


    public function cetak($id)
    {
        $data = Barang::all()->where('id',$id);
        $pdf = FacadePdf::loadview('barang.cetak',compact('data'));
        return $pdf->stream('label-per-barang-pdf');
    }

    public function cetakbarang()
    {
        $data = Barang::all();
        $pdf = FacadePdf::loadview('barang.semua',compact('data'));
        return $pdf->stream('label-semua-barang-pdf');
    }


    public function show($id)
    {
        //
    }

    public function create(Request $request, $id)
    {

        $banyak = $request;
        $data = Ruangan::all();
        return view('barang.inputan', compact('banyak','data'));
    }

    public function store(Request $request): RedirectResponse
    {
        $total = $request->total;
        for($i=1; $i<=$request->total; $i++){
            $barang = new Barang();
            if($request->get('kd-'.$i)==''){
                unset($barang->kode_barang);
                unset($barang->no_urut);
                unset($barang->nama_barang);
                unset($barang->merk);
                unset($barang->tahun_perolehan);
                unset($barang->jumlah);
                unset($barang->anggaran);
                unset($barang->id_ruangan);
            } else {
                $barang->kd_barang = $request->get('kd-'.$i);
                $barang->no_urut = $request->get('urut-'.$i);
                $barang->nama_barang = $request->get('nama_barang-'.$i);
                $barang->merk = $request->get('merk-'.$i);
                $barang->tahun_perolehan = $request->get('tahun-'.$i);
                $barang->jumlah = $request->get('jumlah-'.$i);
                $barang->anggaran = $request->get('anggaran-'.$i);
                $barang->status = 'Ada';
                $barang->id_ruangan = $request->get('ruangan-'.$i);
                $barang->save();
                }

    }
    return redirect('barang')->with(['berhasil' => $total]);
    }
}

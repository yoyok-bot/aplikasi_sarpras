<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kembali;
use App\Models\Pinjam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Prompts\Key;
use Yajra\DataTables\DataTables;

class PinjamController extends Controller
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
        $tanggal = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $thnbulan = $now->year . $now->month;
        $cek = Pinjam::count();
        if($cek == 0){
            $urut = 1;
            $nomer = 'P' . $thnbulan . $urut;
        } else {
            $ambil = Pinjam::all()->last();
            $urut = (int)substr($ambil->kdtransaksi, -1) + 1;
            $nomer = 'P' . $thnbulan . $urut;
        }
        $data = Barang::all();
        return view('pinjam.data', compact('data','nomer'));
    }

    public function pinjam() {
        $data = Pinjam::all();
        return DataTables::of(DB::table('tb_pinjams')
        ->join('tb_barangs','tb_pinjams.id_barang','=','tb_barangs.id')
        ->join('users','tb_pinjams.id_user','=','users.id')
        ->join('tb_kembalis','tb_pinjams.id_kembali','=','tb_kembalis.id')
        ->select('tb_pinjams.id','tb_pinjams.tglpinjam','tb_pinjams.jumlahpinjam','tb_pinjams.statuspinjam','tb_pinjams.id_user','tb_pinjams.id_barang','tb_pinjams.id_kembali','tb_barangs.kd_barang'
        ,'tb_barangs.no_urut','tb_barangs.nama_barang'
        ,'tb_barangs.nama_barang','tb_barangs.merk'
        ,'tb_barangs.tahun_perolehan','tb_barangs.jumlah','tb_barangs.anggaran','users.name','tb_kembalis.tglkembali','tb_kembalis.tglkonfirmasi','tb_kembalis.statuskembali')->get())
        ->addColumn('action',  function ($data) {
            $restore = '<a href="' . route('pinjam.kembali', $data->id) . '" class="btn btn-warning" style="font-size: 15px">Dikembalikan</i></a>';
            $persetujuan = '<a href="' . route('pinjam.setuju', $data->id) . '" class="btn btn-success" style="font-size: 15px">Setuju</i></a>';
            $tidaksetuju = '<a href="' . route('pinjam.tolak', $data->id) . '" class="btn btn-danger" style="font-size: 15px">Tolak</i></a>';
            $jamsekarang = date('Y-m-d',strtotime(now()));
            $start = Carbon::parse($jamsekarang);
            $sekarang = Carbon::parse($data->tglpinjam);
            $end = Carbon::parse($data->tglkembali);
            $tepat = $data->tglkonfirmasi;
            $sisahari = $start->diffInDays($end);
            $ditolak = 'Pinjaman Ditolak Oleh Kepala Sekolah';
            $selesai = 'Sudah Dikembalikan';
            $lanjut = 'Masih Menunggu Persetujuan Kepala Sekolah';
            if($tepat == null ){
            $kembali = 'Masih Dipinjam Selama &nbsp' . $sisahari . '&nbsp';
            }elseif($tepat > $end ){
            $kembali = 'Telat mengembalikan';
            }elseif($tepat >= $end){
            $kembali = 'Jadwal Pengembalian Sekarang';
            }else{
            $kembali = 'Sudah Dikembalikan';
            }
            if($data->statuspinjam == 'Kirim'){
                if(Gate::allows('CRUD KEPSEK')){
                return $persetujuan . '&nbsp' . '&nbsp' . $tidaksetuju;
                }
                return $lanjut;
            }elseif($data->statuspinjam == 'Proses'){
                if($data->id_user == Auth::user()->id){
                    return $restore;
                }
                return $kembali;
            }elseif($data->statuspinjam == 'Ditolak' || $data->statuskembali == 'Ditolak'){
                return $ditolak;
            }else{
                return $selesai;
            }
        })
        ->make(true);
    }

    public function tolak($id)
    {
        $restore= Pinjam::where('id', $id)->first();
        $kd = $restore->kdtransaksi;
        $restore1 = $restore->statuspinjam;
        if($restore1 == 'Kirim'){
            $restore2 = $restore->id_barang;
            $data = Barang::where('id', $restore2)->first();
            $id1 = $data->id;
            if($restore2 == $id1){
                $jumlah = $restore->jumlahpinjam;
                $jumlah2 = $data->jumlah;
                $total = $jumlah2 + $jumlah;
                if($total >= 1){
                Barang::where('id', $id1)
                ->update([
                    'jumlah' => $total,
                    'status' => 'Ada',
                ]);
                Pinjam::where('id', $id)
                ->update([
                    'statuspinjam' => 'Ditolak',
                ]);
                Kembali::where('kdtransaksi', $kd)
                ->update([
                    'statuskembali' => 'Ditolak',
                    'tglkonfirmasi' => now(),
                ]);
                }
                return redirect('pinjam');
            }
            return redirect('pinjam');
        }
        return redirect('pinjam');
    }

    public function setuju($id)
    {
        Pinjam::where('id', $id)
        ->update([
            'statuspinjam' => 'Proses',
        ]);
        return redirect('pinjam');
    }

    public function kembali($id)
    {
        $restore= Pinjam::where('id', $id)->first();
        $restore1 = $restore->statuspinjam;
        $kd = $restore1->kdtransaksi;
        if($restore1 == 'Proses'){
            $restore2 = $restore->id_barang;
            $data = Barang::where('id', $restore2)->first();
            $id1 = $data->id;
            if($restore2 == $id1){
                $jumlah = $restore->jumlahpinjam;
                $jumlah2 = $data->jumlah;
                $total = $jumlah2 + $jumlah;
                if($total >= 1){
                Barang::where('id', $id1)
                ->update([
                    'jumlah' => $total,
                    'status' => 'Ada',
                ]);
                Pinjam::where('id', $id)
                ->update([
                    'statuspinjam' => 'Dipinjam',
                ]);
                Kembali::where('kdtransaksi', $kd)
                ->update([
                    'statuskembali' => 'Dikembalikan',
                    'tglkonfirmasi' => now(),
                ]);
                }
                return redirect('pinjam');
            }
            return redirect('pinjam');
        }
        return redirect('pinjam');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdtransaksi' => 'unique:tb_pinjams',
        ],[
            'kdtransaksi.unique' => 'Kode sudah ada coba ulangi',
        ]);
        $now = $request->tgl;
        $lama = $request->lama;
        $nama = $request->nama;
        $kdtransaksi = $request->kdtransaksi;
        $tgl = date('Y-m-d',strtotime('+'.$lama.'day',strtotime($now)));
        $data = Barang::find($nama);
        $jumlah = $data->jumlah;
        $jumlah2 = $request->jumlah;
        $total = $jumlah - $jumlah2;
        if($total <= 0){
            if($jumlah2 <= $jumlah){
                Kembali::create([
                    'kdtransaksi' => $kdtransaksi,
                    'tglkembali' => $tgl,
                    'jumlahkembali' => $jumlah2,
                    'statuskembali' => 'Proses',
                ]);
                $data = Kembali::where('kdtransaksi', $kdtransaksi)->first();
                $id = $data->id;
                $data->update([
                    'jumlah' => $total,
                    'status' => 'Kosong',
                ]);
                Pinjam::create([
                    'kdtransaksi' => $kdtransaksi,
                    'tglpinjam' => $now,
                    'jumlahpinjam' => $jumlah2,
                    'statuspinjam' =>  'Kirim',
                    'id_user' =>  Auth::user()->id,
                    'id_barang' =>  $request->nama,
                    'id_kembali' => $id,
                ]);
            }
        return redirect('pinjam');;
        }else{
            Kembali::create([
                'kdtransaksi' => $kdtransaksi,
                'tglkembali' => $tgl,
                'jumlahkembali' => $jumlah2,
                'statuskembali' => 'Dikembalikan',
            ]);
            $data->update([
                'jumlah' => $total,
            ]);
            $data = Kembali::where('kdtransaksi', $kdtransaksi)->first();
            $id = $data->id;
            Pinjam::create([
                'kdtransaksi' => $kdtransaksi,
                'tglpinjam' => $now,
                'jumlahpinjam' => $jumlah2,
                'statuspinjam' =>  'Kirim',
                'id_user' =>  Auth::user()->id,
                'id_barang' =>  $request->nama,
                'id_kembali' => $id,
            ]);
        }
        return redirect('pinjam');
    }
}

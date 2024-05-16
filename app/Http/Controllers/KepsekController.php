<?php

namespace App\Http\Controllers;

use App\Models\Kepsek;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KepsekController extends Controller
{
    public function index(Request $request)
    {
        $pencarian = $request->query('cari');
        if (!empty($pencarian)){
            $data = Kepsek::where('nama', 'LIKE', '%'.$pencarian.'%')->paginate(10);
        }else{
        if ($request->id == 10) {

            $data = Kepsek::orderBy('nama')->paginate(10);
            return view('kepsek.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 25){
            $data = Kepsek::orderBy('nama')->paginate(25);
            return view('kepsek.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 50){
            $data = Kepsek::orderBy('nama')->paginate(50);
            return view('kepsek.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 100){
            $data = Kepsek::orderBy('nama')->paginate(100);
            return view('kepsek.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else {
            $data = Kepsek::orderBy('nama')->paginate(10);
            return view('kepsek.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        }
    }
        return view('kepsek.data')->with([
            'data' => $data,
            'cari' => $pencarian
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|min:18|unique:tb_kepseks',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.min' => 'NIP tidak sesuai',
            'nip.unique' => 'NIP sudah diinputkan',
        ]);
        // $data = $request->Nama_siswa;
        // return $siswa;
        $pass = $request->nip;
        $kepsek = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($pass),
            'remember_token' => Str::random(10),
            'status' => 'Aktif',
        ]);
        $kepsek->givePermissionTo('CRUD KEPSEK');
        $kepsek->assignRole('KEPSEK');
        $data = User::where('email',$request->email)->first();
        $id = $data->id;
        Kepsek::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' =>  $request->jenis,
            'tempat' =>  $request->tempat,
            'tanggal_lahir' =>  $request->tgl,
            'alamat' =>  $request->alamat,
            'id_user' => $id,
        ]);
            return redirect('kepsek')->with(['berhasil' => 'Berhasil']);
    }

    public function status($id)
    {
        $user = User::where('id', $id)->first();
        if($user->status == 'Aktif'){
            User::where('id', $id)
            ->update([
                'status' => 'Non Aktif',
            ]);
            return redirect('kepsek')->with(['non' => 'Tidak Aktif']);
        }else{
            User::where('id', $id)
            ->update([
                'status' => 'Aktif',
            ]);
            return redirect('kepsek')->with(['aktif' => 'Aktif']);
        }
        return redirect('kepsek');
    }

    public function password($id)
    {
        $user = User::where('id', $id)->first();
        $kepsek = Kepsek::where('id_user', $user->id)->first();
        $pass = $kepsek->nip;
            User::where('id', $id)
            ->update([
                'password' => Hash::make($pass),
            ]);
            return redirect('kepsek')->with(['reset' => $pass]);
    }

    public function editkepsek($id)
    {

        $data= DB::table('tb_kepseks')
        ->join('users','tb_kepseks.id_user','=','users.id')
        ->select('users.name','users.email','tb_kepseks.id','tb_kepseks.nip'
        ,'tb_kepseks.nama','tb_kepseks.jenis_kelamin'
        ,'tb_kepseks.tempat','tb_kepseks.tanggal_lahir'
        ,'tb_kepseks.alamat','tb_kepseks.id_user')
        ->where('tb_kepseks.id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $iduser = $request->iduser;
        Kepsek::where('id', $id)
        ->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' =>  $request->jenis,
            'tempat' =>  $request->tempat,
            'tanggal_lahir' =>  $request->tgl,
            'alamat' =>  $request->alamat,
        ]);
        User::where('id', $iduser)
        ->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);
        return redirect('kepsek')->with(['ubah' => 'Berhasil']);
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}

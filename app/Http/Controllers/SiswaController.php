<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $pencarian = $request->query('cari');
        if (!empty($pencarian)){
            $data = Siswa::where('nama', 'LIKE', '%'.$pencarian.'%')->paginate(10);
        }else{
        if ($request->id == 10) {

            $data = Siswa::orderBy('nama')->paginate(10);
            return view('siswa.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 25){
            $data = Siswa::orderBy('nama')->paginate(25);
            return view('siswa.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 50){
            $data = Siswa::orderBy('nama')->paginate(50);
            return view('siswa.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 100){
            $data = Siswa::orderBy('nama')->paginate(100);
            return view('siswa.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else {
            $data = Siswa::orderBy('nama')->paginate(10);
            return view('siswa.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        }
    }
        return view('siswa.data')->with([
            'data' => $data,
            'cari' => $pencarian
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|min:8|unique:tb_siswas',
        ],[
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.min' => 'NISN tidak sesuai',
            'nisn.unique' => 'NISN sudah diinputkan',
        ]);
        // $data = $request->Nama_siswa;
        // return $siswa;
        $pass = $request->nisn;
        $siswa = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($pass),
            'remember_token' => Str::random(10),
            'status' => 'Aktif',
        ]);
        $siswa->givePermissionTo('CRUD SISWA');
        $siswa->assignRole('SISWA');
        $data = User::where('email',$request->email)->first();
        $id = $data->id;
        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jenis_kelamin' =>  $request->jenis,
            'tempat' =>  $request->tempat,
            'tanggal_lahir' =>  $request->tgl,
            'alamat' =>  $request->alamat,
            'id_user' => $id,
        ]);
            return redirect('siswa')->with(['berhasil' => 'Berhasil']);
    }

    public function status($id)
    {
        $user = User::where('id', $id)->first();
        if($user->status == 'Aktif'){
            User::where('id', $id)
            ->update([
                'status' => 'Non Aktif',
            ]);
            return redirect('siswa')->with(['non' => 'Tidak Aktif']);
        }else{
            User::where('id', $id)
            ->update([
                'status' => 'Aktif',
            ]);
            return redirect('siswa')->with(['aktif' => 'Aktif']);
        }
        return redirect('siswa');
    }

    public function password($id)
    {
        $user = User::where('id', $id)->first();
        $siswa = Siswa::where('id_user', $user->id)->first();
        $pass = $siswa->nisn;
            User::where('id', $id)
            ->update([
                'password' => Hash::make($pass),
            ]);
            return redirect('siswa')->with(['reset' => $pass]);
    }

    public function editsiswa($id)
    {

        $data= DB::table('tb_siswas')
        ->join('users','tb_siswas.id_user','=','users.id')
        ->select('users.name','users.email','tb_siswas.id','tb_siswas.nisn'
        ,'tb_siswas.nama','tb_siswas.jenis_kelamin'
        ,'tb_siswas.tempat','tb_siswas.tanggal_lahir'
        ,'tb_siswas.alamat','tb_siswas.id_user')
        ->where('tb_siswas.id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $iduser = $request->iduser;
        Siswa::where('id', $id)
        ->update([
            'nisn' => $request->nisn,
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
        return redirect('siswa')->with(['ubah' => 'Berhasil']);
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}

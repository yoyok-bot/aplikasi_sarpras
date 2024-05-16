<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $pencarian = $request->query('cari');
        if (!empty($pencarian)){
            $data = Guru::where('nama', 'LIKE', '%'.$pencarian.'%')->paginate(10);
        }else{
        if ($request->id == 10) {

            $data = Guru::orderBy('nama')->paginate(10);
            return view('guru.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 25){
            $data = Guru::orderBy('nama')->paginate(25);
            return view('guru.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 50){
            $data = Guru::orderBy('nama')->paginate(50);
            return view('guru.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else if ($request->id == 100){
            $data = Guru::orderBy('nama')->paginate(100);
            return view('guru.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        } else {
            $data = Guru::orderBy('nama')->paginate(10);
            return view('guru.data')->with([
                'data' => $data,
                'cari' => $pencarian
            ]);
        }
    }
        return view('guru.data')->with([
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
        $guru = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($pass),
            'remember_token' => Str::random(10),
            'status' => 'Aktif',
        ]);
        $guru->givePermissionTo('CRUD GURU');
        $guru->assignRole('GURU');
        $data = User::where('email',$request->email)->first();
        $id = $data->id;
        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' =>  $request->jenis,
            'tempat' =>  $request->tempat,
            'tanggal_lahir' =>  $request->tgl,
            'alamat' =>  $request->alamat,
            'id_user' => $id,
        ]);
            return redirect('guru')->with(['berhasil' => 'Berhasil']);
    }

    public function status($id)
    {
        $user = User::where('id', $id)->first();
        $status = $user->status;
        if($user->status == 'Aktif'){
            User::where('id', $id)
            ->update([
                'status' => 'Non Aktif',
            ]);
            return redirect('guru')->with(['non' => 'Tidak Aktif']);
        }else{
            User::where('id', $id)
            ->update([
                'status' => 'Aktif',
            ]);
            return redirect('guru')->with(['aktif' => 'Aktif']);
        }
        return redirect('guru')->with(['status' => $status]);
    }

    public function password($id)
    {
        $user = User::where('id', $id)->first();
        $guru = Guru::where('id_user', $user->id)->first();
        $pass = $guru->nip;
            User::where('id', $id)
            ->update([
                'password' => Hash::make($pass),
            ]);
            return redirect('guru')->with(['reset' => $pass]);
    }

    public function editguru($id)
    {

        $data= DB::table('tb_gurus')
        ->join('users','tb_gurus.id_user','=','users.id')
        ->select('users.name','users.email','tb_gurus.id','tb_gurus.nip'
        ,'tb_gurus.nama','tb_gurus.jenis_kelamin'
        ,'tb_gurus.tempat','tb_gurus.tanggal_lahir'
        ,'tb_gurus.alamat','tb_gurus.id_user')
        ->where('tb_gurus.id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $iduser = $request->iduser;
        Guru::where('id', $id)
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
        return redirect('guru')->with(['ubah' => 'Berhasil']);
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}

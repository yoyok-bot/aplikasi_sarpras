<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hapusbarang;
use App\Models\Pinjam;
use App\Models\Servicebarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Barang::all();
        $data1 = Hapusbarang::all();
        $data3 = Pinjam::all()->where('statuspinjam', 'Proses');
        $data4 = Servicebarang::all()->where('status', 'Selesai');
        $total = $data->count();
        $total2 = $data1->count();
        $total3 = $data3->count();
        $total4 = $data4->count();
        return view('dashboard', compact('total','total2','total3','total4'));
    }

    public function password($id)
    {
            User::where('id', $id)
            ->update([
                'password' => Hash::make('admin'),
            ]);
            return redirect('/')->with(['reset']);
    }

    public function edituser($id)
    {

        $data= User::where('id', $id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $passlama = $request->passlama;
        $passbaru1 = $request->passbaru1;
        $passbaru2 = $request->passbaru2;
        $data= User::where('id', $id)->first();
        $check = $data->password;
        if(Hash::check($passlama, $check)){
            if($passbaru1 == $passbaru2){
            User::where('id', $id)
            ->update([
                'password' => Hash::make($passbaru1),
            ]);
            return redirect('/')->with(['berhasil' => 'Berhasil']);
        }
        return redirect('/')->with(['baru' => 'Baru']);
    }
        return redirect('/')->with(['lama' => 'Lama']);
    }
}

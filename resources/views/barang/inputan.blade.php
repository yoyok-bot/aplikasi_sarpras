@extends('layouts.app')
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Tambah Barang</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item active">Tambah Banyak</li>
@endsection
@section('isi')
    <div class="float-right">
        <a href="{{ url('barang') }}" class="btn btn-warning btn-sm">
            <i class="fa fa-undo"></i> Kembali
        </a>
    </div>
        <br>
        <br>
            <form action="{{ url('barang')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @csrf
                <input type="hidden" name="id" value="{{$banyak->id}}">
                    <input type="hidden" name="total" value="{{$banyak->count_add}}">
                    @for ($i=1; $i<=$_POST['count_add']; $i++)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Barang {{$i}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Kode barang</label>
                        <input type="number" class="form-control" id="val-username" name="kd-{{$i}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">No Urut</label>
                        <input type="number" class="form-control" id="val-username" name="urut-{{$i}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Barang</label>
                            <input type="text" class="form-control" id="val-username" name="nama_barang-{{$i}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Merk</label>
                            <input type="text" class="form-control" id="val-email" name="merk-{{$i}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tahun Perolehan</label>
                            <select class="form-control" id="val-skill" name="tahun-{{$i}}">
                                <option value="">Please select</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2028">2027</option>
                                <option value="2029">2028</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah</label>
                            <input type="number"  min="1" max="100" class="form-control" id="val-suggestions" name="jumlah-{{$i}}" rows="5" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Anggaran</label>
                            <select class="form-control" id="val-skill" name="anggaran-{{$i}}">
                                <option value="">Please select</option>
                                <option value="BOS REGULER">BOS REGULER</option>
                                <option value="SILPA">SILPA</option>
                                <option value="APBD">APBD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ruangan</label>
                            <select class="form-control" id="val-skill" name="ruangan-{{$i}}">
                                <option value="">Please select</option>
                                @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                    <hr class="hr hr-blurry" />
                @endfor
                <div class="row float-right">
                    <div class="float-right">
                        <button type="submit" class="btn-lg btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <br>
            <br>
            <br>
@endsection

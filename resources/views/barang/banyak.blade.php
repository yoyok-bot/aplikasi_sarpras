@extends('layouts.app')
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Edit Barang</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item active">Edit Banyak</li>
@endsection
@section('isi')
    <div class="float-right">
        <a href="{{ url('barang') }}" class="btn btn-warning btn-sm">
            <i class="fa fa-undo"></i> Kembali
        </a>
    </div>
        <br>
        <br>
            <form action="{{route('barang.update')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
               @method('PUT')
                @csrf
                    @foreach($data as $item)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Barang {{ $loop->iteration }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Kode barang</label>
                        <input type="hidden" name="id[]" value="{{$item->id}}">
                        <input type="number" class="form-control" id="val-username" value="{{$item->kd_barang}}" name="kd[]" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">No Urut</label>
                        <input type="number" class="form-control" id="val-username" name="urut[]" value="{{$item->no_urut}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Barang</label>
                            <input type="text" class="form-control" id="val-username" name="nama_barang[]" value="{{$item->nama_barang}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Merk</label>
                            <input type="text" class="form-control" id="val-email" name="merk[]" value="{{$item->merk}}" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tahun Perolehan</label>
                            <select class="form-control" id="val-skill" name="tahun[]">
                                <option value="">Please select</option>
                                <option value="2023" {{ $item->tahun_perolehan == 2023 ? 'selected' : '' }}>2023</option>
                                <option value="2024" {{ $item->tahun_perolehan == 2024 ? 'selected' : '' }}>2024</option>
                                <option value="2025" {{ $item->tahun_perolehan == 2025 ? 'selected' : '' }}>2025</option>
                                <option value="2026" {{ $item->tahun_perolehan == 2026 ? 'selected' : '' }}>2026</option>
                                <option value="2028" {{ $item->tahun_perolehan == 2027 ? 'selected' : '' }}>2027</option>
                                <option value="2029" {{ $item->tahun_perolehan == 2028 ? 'selected' : '' }}>2028</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah</label>
                            <input type="number"  min="1" max="100" class="form-control" value="{{$item->jumlah}}" id="val-suggestions" name="jumlah[]" rows="5" placeholder="Isi disini">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Anggaran</label>
                            <select class="form-control" id="val-skill" name="anggaran[]">
                                <option value="">Please select</option>
                                <option value="BOS REGULER" {{ $item->anggaran == 'BOS REGULER' ? 'selected' : '' }}>BOS REGULER</option>
                                <option value="SILPA" {{ $item->anggaran == 'SILPA' ? 'selected' : '' }}>SILPA</option>
                                <option value="APBD" {{ $item->anggaran == 'APBD' ? 'selected' : '' }}>APBD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Lokasi Ruangan</label>
                            <select class="form-control" id="val-skill" name="ruangan[]">
                                <option value="">Please select</option>
                                @foreach ($data1 as $item1)
                                <option value="{{$item1->id}}" {{ $item1->id == $item->id_ruangan ? 'selected' : '' }}>{{$item1->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                    <hr class="hr hr-blurry" />
                @endforeach
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

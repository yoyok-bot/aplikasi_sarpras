@extends('layouts.app')
@section('atas')
<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Data User</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Guru</a>
  </li>
@endsection
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Data Guru</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Guru</a></li>
<li class="breadcrumb-item active">Data</li>
@endsection
@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('asset/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- DataTables -->
<link href="{{asset('plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('isi')
@php
    $pilihan = 0;
    if (Request::has('id')){
        $pilihan = Request::get('id');
    }
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="general-button">
                    @if(Session::has('berhasil'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                        Berhasil Tambah
                      </div>
                      @elseif(Session::has('ubah'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                        Diedit
                      </div>
                      @elseif(Session::has('reset'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil Reset</h5>
                        Password adalah : {{Session::get('reset')}}
                      </div>
                      @elseif(Session::has('non'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Berhasil</h5>
                        Akun Dinonaktifkan
                      </div>
                      @elseif(Session::has('aktif'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                        Akun Diaktifkan
                      </div>
                    @endif
                    <div class="float-right">
                        <button type="button" class="tambah btn mb-1 btn-primary">Tambah <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <br>
                    <br>
                    <br>
                    @if($cari=='')
                        <p class="float-left card-inside-title" style="margin-top: 0px;margin-bottom: 0px">Show  &nbsp;&nbsp;
                        <div class="float-left">
                          <div class="form-group">
                            <select name="keterangan" class="form-control-sm show-tick" id="list">
                          <option value="10"  {{ $pilihan==10 ? 'selected="selected"' : '' }} ><a>10</a></option>
                          <option  value="25" {{ $pilihan==25 ? 'selected="selected"' : '' }}><a>25</a></option>
                          <option  value="50" {{ $pilihan==50 ? 'selected="selected"' : '' }}><a>50</a></option>
                          <option  value="100" {{ $pilihan==100 ? 'selected="selected"' : '' }}><a>100</a></option>
                          </select>
                          </div>
                        </p>
                        </div> &nbsp;&nbsp; entries
                    @endif
                          <div class="float-right">
                            <form class="form-inline my-2 my-lg-0" type="get" action="{{url('/kepsek')}}">
                                <input class="form-control" type="search" name="cari" value="{{ $cari }}" placeholder="Search" aria-label="Search">
                                &nbsp;&nbsp;
                                <button class="btn btn-default" type="submit">Pencarian</button>
                              </form>
                          </div>
                      </div>
                <table id="tablebarang" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th width='10%'>No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th width='15%' >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($data))
                    @php
                    $nomor = 1 + (($data->currentPage() - 1) * $data->perPage())
                    @endphp
                        @foreach ($data as $item)
                      <tr>
                        <td class="text-center">{{ $nomor++ }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                          <td>{{ $item->user->status }}</td>
                          <td class="text-center">
                            <a href="#" data-toggle="modal" data="{{$item->id}}" class="btn btn-success editguru" data-target="#editguru" style="font-size: 15px"><i class="fa fa-edit"></i></a>
                            <a href="#" data-id="{{$item->id_user}}" class="btn btn-danger hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i></a>
                            <a href="{{ route('guru.reset', $item->id_user)}}" class="btn btn-warning">
                                <i class="fa fa-refresh"></i>
                              </a>
                            @if($item->user->status == 'Aktif')
                            <a href="{{ route('guru.status', $item->id_user)}}" class="btn btn-danger">
                              <i class="fa fa-ban"></i>
                            </a>
                            @else
                            <a href="{{ route('guru.status', $item->id_user)}}" class="btn btn-success">
                              <i class="fa fa-check"></i>
                            </a>
                          @endif
                          </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                          <td colspan="7" class="text-center"> Tidak ada data </td>
                      </tr>
                    @endif
                    </tbody>
                </table>
                <br>
                Showing
                    {{$data->firstitem()}}
                    to
                    {{$data->lastitem()}}
                    of
                    {{$data->total()}}
                    entries
                    <div class="float-right">
                    {!! $data->appends(Request::except('page'))->render() !!}
                    </div>
            </div>
        </div>
    </div>
</div>
@include('guru.tambah')
@include('guru.edit')
@endsection
@push('script')
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script>
    var del = function (id) {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Iya!",
                        cancelButtonText: "Tidak!",
                    }).then(
                        function (result) {
                            $.ajax({
                                url: "hapus_guru/" + id+"/delete",
                                method: "DELETE",
                            }).done(function (msg) {
                                swal("Deleted!", "Data sudah terhapus.", "success");
                                location.reload();
                            }).fail(function (textStatus) {
                                swal("Gagal", "Ruangan tidak bisa dihapus karena masih ada data barang diruangan ini", "error");
                            });
                        }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                            swal("Cancelled", "Data batal dihapus", "error");
                        });
                };
                $('body').on('click', '.hapus-data', function () {
                    del($(this).attr('data-id'));
        $('#list').change(function () {
            document.location.href = '{{url('guru')}}/?id=' + $('#list').val();
            });
                });
</script>
@endpush

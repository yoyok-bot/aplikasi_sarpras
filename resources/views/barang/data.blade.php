@extends('layouts.app')
@section('atas')
<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Data Master</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Barang</a>
  </li>
@endsection
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Data Barang</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item active">Data</li>
@endsection
@section('isi')
@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('asset/plugins/fontawesome-free/css/all.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link href="{{asset('plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="general-button">
                    @if(Session::has('berhasil'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                        Berhasil Tambah {{ session::get('berhasil')}} Barang
                      </div>
                      @elseif(Session::has('ubah'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                        Diedit {{ session::get('ubah')}} Barang
                      </div>
                      @elseif(Session::has('service'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil Proses</h5>
                        Service {{ session::get('service')}} Barang
                      </div>
                    @endif
                    @can('CRUD ADMIN')
                    <div class="float-right">
                        <button type="button" class="show-detail btn mb-1 btn-primary">Tambah<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <div class="text-center">
                        <a href="{{route('barang.label')}}" class="btn mb-1 btn-warning" target="_blank">Print Label &nbsp;<i class="fa fa-print"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="edit btn mb-1 btn-secondary">Edit Barang &nbsp;<i class="fa fa-edit"></i></span></a>
                    </div>
                    @endcan
                    <br>
                </div>
                <table id="tablebarang" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tahun Perolehan</th>
                            <th>Anggaran</th>
                            <th>Lokasi Ruangan</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('barang.ceklisedit')
@include('barang.tambah')
@include('barang.inputhapus')
@include('barang.service')
@include('barang.edit')
@include('barang.show')
@endsection
@push('script')
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('asset/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('asset/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var dt = $('#tablebarang').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "bDestroy": true,
            language: {
                url: '{{asset('asset/plugins/datatables-bahasa/bahasa.json')}}',
            },
            ajax: '{{route('data.table')}}',
            "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1)
    },

            columns: [{
                data: 'id', width: '10px',
                name: 'id', className: 'text-center', width: '4%'
            },
                {
                    data: 'nama_barang', width: '80px',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah', width: '30px',
                    name: 'jumlah'
                },

                {
                    data: 'tahun_perolehan', width: '30px',
                    name: 'tahun_perolehan'
                },
                {
                    data: 'anggaran', width: '30px',
                    name: 'anggaran'
                },
                {
                    data: 'nama_ruangan', width: '30px',
                    name: 'nama_ruangan'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center',
        width: '17%'},
            ]
        });
    });
</script>

@endpush

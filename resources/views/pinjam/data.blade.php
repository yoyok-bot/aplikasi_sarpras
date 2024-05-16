@extends('layouts.app')
@section('atas')
<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Peminjaman</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Dat1</a>
  </li>
@endsection
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Data peminjaman</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
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
                    <div class="float-right">
                        <button type="button" class="tambah btn mb-1 btn-primary">Pinjam barang <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
                <table id="tablepinjam" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal Pinjam</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Kembali</th>
                            <th>Dipinjam Oleh</th>
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
@include('pinjam.tambah')
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
        var dt = $('#tablepinjam').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "bDestroy": true,
            language: {
                url: '{{asset('asset/plugins/datatables-bahasa/bahasa.json')}}',
            },
            ajax: '{{route('pinjam.table')}}',
            "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1)
    },

            columns: [{
                data: 'id', width: '10px',
                name: 'id', className: 'text-center', width: '4%'
            },
            {
                    data: 'tglpinjam', width: '80px',
                    name: 'tglpinjam'
                },
                {
                    data: 'nama_barang', width: '80px',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlahpinjam', width: '80px',
                    name: 'jumlahpinjam',
                },
                {
                    data: 'tglkembali', width: '80px',
                    name: 'tglkembali'
                },
                {
                    data: 'name', width: '80px',
                    name: 'name'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center',
        width: '20%'},
            ]
        });
            });
</script>
@endpush

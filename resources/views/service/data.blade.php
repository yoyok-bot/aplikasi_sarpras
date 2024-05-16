@extends('layouts.app')
@section('atas')
<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Rusak Ringan</a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Data</a>
  </li>
@endsection
@section('title', 'Dashboard')
@section('labeldash')
<h1 class="m-0">Data Rusak Ringan</h1>
@endsection
@section('labelbread')
<li class="breadcrumb-item"><a href="#">Rusak Ringan</a></li>
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
                    <br>
                </div>
                <table id="tableservice" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Keterangan</th>
                            <th>Dibuat</th>
                            <th>Diubah</th>
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
        var dt = $('#tableservice').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "bDestroy": true,
            language: {
                url: '{{asset('asset/plugins/datatables-bahasa/bahasa.json')}}',
            },
            ajax: '{{route('service.table')}}',
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
                    data: 'jumlahperbaikan', width: '80px',
                    name: 'jumlahperbaikan'
                },
                {
                    data: 'keterangan', width: '80px',
                    name: 'keterangan'
                },
                {
                    data: 'created_at', width: '80px',
                    name: 'created_at'
                },
                {
                    data: 'updated_at', width: '80px',
                    name: 'updated_at'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center',
        width: '15%'},
            ]
        });
            });
</script>
@endpush

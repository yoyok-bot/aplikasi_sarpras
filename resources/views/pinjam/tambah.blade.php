@push('css')

<link rel="stylesheet" href="{{asset('asset/plugins/daterangepicker/daterangepicker.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('asset/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{asset('asset/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{asset('asset/plugins/bs-stepper/css/bs-stepper.min.css')}}">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset('asset/plugins/dropzone/min/dropzone.min.css')}}">
@endpush
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pinjam Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{('pinjam')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="tgl">Kode Traksaksi</label>
                    <input type="text" name="kdtransaksi" value="{{$nomer}}" class="form-control @error('kdtransaksi')
                    is-invalid @enderror" readonly>
                    @error('kdtransaksi')
                    <div style="font-size: 12px; color:red">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="tgl">Tanggal Pinjam</label>
                    <input type="date" name="tgl" value="{{date('Y-m-d')}}" class="form-control @error('tgl')
                    is-invalid @enderror" value="{{ old('tgl')}}" readonly>
                </div>
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select class="form-control select2bs4 @error('ama')
                    is-invalid @enderror" name="nama" value="{{ old('nama')}}" style="width: 100%;">
                        <option value="">Please select</option>
                        @foreach ($data as $item)
                        <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah pinjam</label>
                    <input type="text" name="jumlah" value="{{ old('jumlah')}}" class="form-control @error('jumlah')
                    is-invalid @enderror" required>
                </div>
                <div class="form-group">
                    <label for="lama">Lama meminjam</label>
                    <input type="text" name="lama" value="{{ old('lama')}}" class="form-control @error('lama')
                    is-invalid @enderror" required>
                </div>
                <br>
                <div class="form-group float-right">
                    <input type="submit" name="generate" value="Simpan" class="btn btn-success">
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@push('script')
<script>
     $('body').on("click", '.tambah', function (e) {
        $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
            $('#myModal').modal("show");
});
</script>

<!-- Select2 -->
<script src="{{asset('asset/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('asset/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('asset/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('asset/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('asset/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('asset/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('asset/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('asset/plugins/dropzone/min/dropzone.min.js')}}"></script>
@endpush

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{('guru')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control @error('nip')
                    is-invalid @enderror" value="{{ old('nip')}}" required>
                    @error('nip')
                    <div style="font-size: 12px; color:red">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama')
                    is-invalid @enderror" value="{{ old('nama')}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email')}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Kelamin</label>
                    <select class="form-control" id="val-skill" name="jenis">
                        <option value="">Please select</option>
                        <option value="L" {{ old('jenis') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="P" {{ old('jenis') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <label for="tempat">Tempat/Tanggal Lahir</label>
                <div class="row">
                    <div class="col-5">
                        <input type="text" name="tempat" value="{{ old('tempat')}}" class="form-control" required>
                    </div>
                    /
                    <div class="col-6">
                        <input type="date" name="tgl" value="{{ old('tgl')}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat')}}</textarea>
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
            $('#myModal').modal("show");
});
</script>
@endpush

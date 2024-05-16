<div class="modal fade" id="editsiswa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('siswa.update')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="hidden" id="idsiswa" name="id" class="form-control" required>
                    <input type="hidden" id="iduser" name="iduser" class="form-control" required>
                    <input type="text" id="nisn" name="nisn" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Kelamin</label>
                    <select class="form-control" id="jenis" name="jenis">
                        <option value="">Please select</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <label for="tempat">Tempat/Tanggal Lahir</label>
                <div class="row">
                    <div class="col-5">
                        <input type="text" id="tempat" name="tempat" class="form-control" required>
                    </div>
                    /
                    <div class="col-6">
                        <input type="date" id="tgl" name="tgl" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
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
$('body').on("click", '.editsiswa', function (e) {
            $('#editsiswa').modal("show");
            $.get("siswa/edit/" + $(this).attr('data'), function (data) {
                console.log(data);
                $('#idsiswa').val(data.id);
                $('#iduser').val(data.id_user);
                $('#nisn').val(data.nisn);
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                $('#jenis').val(data.jenis_kelamin);
                $('#tempat').val(data.tempat);
                $('#tgl').val(data.tanggal_lahir);
                $('#alamat').val(data.alamat);
            });
        });
    </script>
    @endpush

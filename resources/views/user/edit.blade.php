<div class="modal fade" id="edituser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('user.update')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('HEAD')
                @csrf
                <div class="form-group">
                    <label for="pass">Password Lama</label>
                    <input type="hidden" id="iduser" name="id" class="form-control" required>
                    <input id="passwordlama" type="password" name="passlama" class="form-control" required>
                    <span class="fa fa-fw field-icon passwordlama-toggle-icon"><i class="fas fa-eye"></i></span>
                </div>
                <div class="form-group">
                    <label for="pass">Password Baru</label>
                    <input id="passwordbaru1" type="password" name="passbaru1" class="form-control" required>
                    <span class="fa fa-fw field-icon passwordbaru1-toggle-icon"><i class="fas fa-eye"></i></span>
                </div>
                <div class="form-group">
                    <label for="pass">Konfirmasi Password Baru</label>
                    <input id="passwordbaru2" type="password" name="passbaru2" class="form-control" required>
                    <span class="fa fa-fw field-icon passwordbaru2-toggle-icon"><i class="fas fa-eye"></i></span>
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
$('body').on("click", '.edituser', function (e) {
            $('#edituser').modal("show");
            $.get("user/edit/" + $(this).attr('data-user'), function (data) {
                console.log(data);
                $('#iduser').val(data.id);
            });
        });
    </script>
    @endpush

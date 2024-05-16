<div class="modal fade" id="editruangan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('ruangan.update')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="ruangan">Nama Ruangan</label>
                    <input type="hidden" name="id" id="id" class="form-control" required>
                    <input type="text" name="nama_ruangan" id="nama" class="form-control" required>
                </div>
                @error('count_add')
                    <div style="font-size: 12px; color:red">{{ $message }}</div>
                @enderror
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
$('body').on("click", '.editdata', function (e) {
            $('#editruangan').modal("show");
            $.get("ruangan/edit/" + $(this).attr('data'), function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nama').val(data.nama_ruangan);
            });
        });
    </script>
    @endpush

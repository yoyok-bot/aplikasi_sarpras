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
            <form action="{{('ruangan')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="ruangan">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control" required>
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
     $('body').on("click", '.tambah', function (e) {
            $('#myModal').modal("show");
});
</script>
@endpush

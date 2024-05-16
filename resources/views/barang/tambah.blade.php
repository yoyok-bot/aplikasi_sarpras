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
        <form action="" method="POST" id="tambah">
            @method('GET')
            @csrf
            <div class="form-group">
                <label for="count_add">Jumlah Barang Inputan</label>
                <input type="hidden" id="id" name="id" value="1">
                <input type="number" name="count_add" id="count_add"  class="form-control" min="1" max="5" required>
            </div>
            @error('count_add')
                <div style="font-size: 12px; color:red">{{ $message }}</div>
            @enderror
            <br>
            <div class="form-group pull-right">
                <input type="submit" name="generate" value="Buat Inputan" class="btn btn-success">
            </div>
        </form>
                <!-- /.card -->\
    </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@push('script')
<script>
     $('body').on("click", '.show-detail', function (e) {
            $('#myModal').modal("show");
            $.get("/barang/" + $(this).attr('data'), function (data) {
                console.log(data);
                $('#id').text(data.id);
                $('#count_add').text(data.count_add);
                $('#tambah').attr("action", "/barang/create/"+data.count_add);
  });
});
</script>
@endpush

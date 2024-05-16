<div class="modal fade" id="inputbarang">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('hapus')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('GET')
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukkan jumlah barang yang rusak berat</label>
                    <input type="hidden" id="idhapus" name="id" >
                    <input type="number" class="form-control" name="input" placeholder="Jumlah Barang">
                    </div>
                <br>
                <div class="form-group float-right">
                    <input type="submit" name="generate" value="Barang dihapus" class="btn btn-danger">
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
$('body').on("click", '.inputbarang', function (e) {
            $('#inputbarang').modal("show");
            $.get("barang/input/" + $(this).attr('data-input'), function (data) {
                console.log(data);
                $('#idhapus').val(data.id);
            });
        });
    </script>
    @endpush

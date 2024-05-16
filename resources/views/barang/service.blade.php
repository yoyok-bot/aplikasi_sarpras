<div class="modal fade" id="servicebarang">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Perbaikan Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('data.proses')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('GET')
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukkan jumlah barang yang butuh perbaikan</label>
                    <input type="hidden" id="idservice" name="id" >
                    <input type="number" class="form-control" name="input" placeholder="Jumlah Barang">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan Kerusakan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>
                <br>
                <div class="form-group float-right">
                    <input type="submit" name="generate" value="Barang diperbaiki" class="btn btn-danger">
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
$('body').on("click", '.servicebarang', function (e) {
            $('#servicebarang').modal("show");
            $.get("barang/service/" + $(this).attr('data-service'), function (data) {
                console.log(data);
                $('#idservice').val(data.id);
                $('#jumlahperbaikan').val(data.jumlahperbaikan);
            });
        });
    </script>
    @endpush

<div class="modal fade" id="editbarangsatu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('barang.update')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode barang</label>
                    <input type="hidden" id="id1" name="id[]" >
                    <input type="number" class="form-control" id="kd" name="kd[]" placeholder="Isi disini">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">No Urut</label>
                    <input type="number" class="form-control" id="no" name="urut[]"  placeholder="Isi disini">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama_barang[]"  placeholder="Isi disini">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Merk</label>
                        <input type="text" class="form-control" id="merk1" name="merk[]"  placeholder="Isi disini">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tahun Perolehan</label>
                        <select class="form-control" id="tahun" name="tahun[]">
                            <option value="">Please select</option>
                            <option value="2023" >2023</option>
                            <option value="2024" >2024</option>
                            <option value="2025" >2025</option>
                            <option value="2026" >2026</option>
                            <option value="2028" >2027</option>
                            <option value="2029" >2028</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah</label>
                        <input type="number"  min="1" max="100" class="form-control"  id="jumlah1" name="jumlah[]" rows="5" placeholder="Isi disini">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Anggaran</label>
                        <select class="form-control" id="anggaran1" name="anggaran[]">
                            <option value="">Please select</option>
                            <option value="BOS REGULER" >BOS REGULER</option>
                            <option value="SILPA" >SILPA</option>
                            <option value="APBD" >APBD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Lokasi Ruangan</label>
                        <select class="form-control" id="ruangan1" name="ruangan[]">
                            <option value="">Please select</option>
                            @foreach ($data1 as $item1)
                            <option value="{{$item1->id}}">{{$item1->nama_ruangan}}</option>
                            @endforeach
                        </select>
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
$('body').on("click", '.editbarangsatu', function (e) {
            $('#editbarangsatu').modal("show");
            $.get("barang/ubah/" + $(this).attr('data-editsatu'), function (data) {
                console.log(data);
                $('#id1').val(data.id);
                $('#kd').val(data.kd_barang);
                $('#no').val(data.no_urut);
                $('#nama').val(data.nama_barang);
                $('#merk1').val(data.merk);
                $('#tahun').val(data.tahun_perolehan);
                $('#jumlah1').val(data.jumlah);
                $('#anggaran1').val(data.anggaran);
                $('#ruangan1').val(data.id_ruangan);
            });
        });
    </script>
    @endpush

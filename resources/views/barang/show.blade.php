<div id="showbarang" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
                <div id="printThis" class="modal-body">
                    <div class="table-responsive">
                        <table class="table borderless">
                            <tr>
                                <th>Kode Barang</th>
                                <td id="kd_barang" style="text-transform: capitalize"></td>
                            </tr>
                            <tr>
                                <th>No Urut</th>
                                <td id="no_urut" style="text-transform: capitalize"></td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td id="nama_barang" style="text-transform: capitalize"></td>
                            </tr>
                            <tr>
                                <th>Merk Barang</th>
                                <td id="merk"></td>
                            </tr>
                            <tr>
                                <th>Tahun Perolehan</th>
                                <td id="tahun_perolehan"></td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td id="jumlah" ></td>
                            </tr>
                            <tr>
                                <th>Anggaran</th>
                                <td id="anggaran"></td>
                            </tr>
                            <tr>
                                <th>Lokasi Ruangan</th>
                                <td id="ruangan"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    @push('script')
    <script>
$('body').on("click", '.show-data-barang', function (e) {
            $('#showbarang').modal("show");
            $.get("show/" + $(this).attr('data'), function (data) {
                console.log(data);
                $('#kd_barang').text(': ' +data.kd_barang);
                $('#no_urut').text(': ' +data.no_urut);
                $('#nama_barang').text(': ' +data.nama_barang);
                $('#merk').text(': ' +data.merk);
                $('#tahun_perolehan').text(': ' +data.tahun_perolehan);
                $('#jumlah').text(': ' +data.jumlah);
                $('#anggaran').text(': ' +data.anggaran);
                $('#ruangan').text(': ' +data.nama_ruangan);
            });
        });
    </script>
    @endpush

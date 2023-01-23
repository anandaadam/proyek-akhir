<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Retur Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card p-3">
                    <form action="<?= base_url('DetailReturPembelian/save') ?>" method="POST">
                        <h5 class="text-primary">Data Retur Pembelian</h5>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="id-retur-bahan">Nama Bahan</label>
                                <select id="id-retur-bahan" name="id_retur_bahan" class="form-control select2 id-retur-bahan">
                                    <?php foreach ($dataListBahan->getResult() as $data) { ?>
                                        <option value="<?= $data->id_bahan ?>-<?= $data->harga_pembelian ?>"><?= $data->nama_bahan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Jumlah Retur</label>
                                <input type="number" name="jumlah_retur_pembelian" class="form-control jumlah-retur-pembelian">
                            </div>
                        </div>
                        <div class="text-right mb-4">
                            <button class="btn btn-success btn-tambah-retur-bahan" type="button">Tambah</button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Bahan</th>
                                    <th scope="col">Jumlah Retur</th>
                                    <th scope="col">Batalkan</th>
                                </tr>
                            </thead>
                            <tbody class="tabel-retur-pembelian">
                            </tbody>
                        </table>
                        <div class=" text-right">
                            <h6 class="total-retur-pembelian">Total Retur pembelian: </h6>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
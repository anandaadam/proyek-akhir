<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Item Transaksi Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card p-3">
                    <form action="<?= base_url('DetailPembelian/save') ?>" method="POST">
                        <h5 class="text-primary">Data Pembelian</h5>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="id_bahan">Nama Bahan</label>
                                <select id="id_bahan" name="id_bahan" class="form-control select2 id-bahan">
                                    <?php foreach ($dataBahan->getResult() as $data) { ?>
                                        <option value="<?= $data->id_bahan ?>"><?= $data->nama_bahan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Harga Bahan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" name="harga_pembelian" class="form-control currency harga-pembelian <?= ($messageValidation->hasError('harga_pembelian')) ? 'is-invalid' : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Jumlah Pembelian</label>
                                <input type="number" name="jumlah_pembelian" class="form-control jumlah-pembelian <?= ($messageValidation->hasError('jumlah_pembelian')) ? 'is-invalid' : '' ?>">
                            </div>
                        </div>

                        <div class="text-right mb-4">
                            <button class="btn btn-success btn-tambah-bahan" type="button">Tambah</button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Bahan</th>
                                    <th scope="col">Harga Pembelian</th>
                                    <th scope="col">Jumlah Pembelian</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Batalkan</th>
                                </tr>
                            </thead>
                            <tbody class="tabel-pembelian">
                            </tbody>
                        </table>
                        <div class=" text-right">
                            <h6 class="total-pembelian">Total pembelian: </h6>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
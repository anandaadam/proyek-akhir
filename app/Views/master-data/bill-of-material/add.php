<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bill Of Material</h1>
        </div>
        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <form action="<?= base_url('BillOfMaterial/store/' . $idBom) ?>" method="POST">
                        <div class="card-header">
                            <h4>Silahkan isi form</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" id="nama_produk" class="form-control" name="nama_produk" value="<?= $namaProduk ?>" disabled>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Pilih Bahan</label>
                                    <select id="bahan" name="bahan" class="form-control select2 bahan-bom">
                                        <?php foreach ($dataBahan->getResult() as $data) { ?>
                                            <?php if (old('bahan') == $data->id_bahan) { ?>
                                                <option value="<?= $data->id_bahan ?>" selected><?= $data->nama_bahan ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $data->id_bahan ?>"><?= $data->nama_bahan ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="jumlah_bahan">Jumlah Bahan</label>
                                    <input id="jumlah_bahan" type="number" class="form-control jumlah-bahan-bom <?= ($messageValidation->hasError('jumlah_bahan')) ? 'is-invalid' : '' ?>" name="jumlah_bahan" placeholder="Silahkan isi jumlah bahan" value="<?= old('jumlah_bahan') ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('jumlah_bahan') ?></div>
                                </div>
                            </div>

                            <div class="text-right mb-4">
                                <button class="btn btn-success btn-tambah-bahan-bom" type="button">Tambah</button>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Jumlah Bahan</th>
                                        <th scope="col">Batalkan</th>
                                    </tr>
                                </thead>
                                <tbody class="tabel-bom">
                                </tbody>
                            </table>
                            <div class="d-none container-input-bom">
                                <input type="hidden" name="jumlah_bom" class="jumlah-bom" value="0">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary btn-submit-bom" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>
</section>
</div>
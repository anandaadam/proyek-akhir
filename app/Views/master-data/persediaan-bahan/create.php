<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Persediaan Bahan</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <form action="<?= base_url('PersediaanBahan/store') ?>" method="POST">
                        <div class="card-header">
                            <h4>Silahkan isi form</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Bahan</label>
                                <input type="text" id="nama_bahan" class="form-control <?= ($messageValidation->hasError('nama_bahan')) ? 'is-invalid' : '' ?>" name="nama_bahan" placeholder="Silahkan isi nama bahan" value="<?= old('nama_bahan') ?>">
                                <div class="invalid-feedback"><?= $messageValidation->getError('nama_bahan') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Satuan</label>
                                <select id="jenis_satuan" name="jenis_satuan" class="form-control select2">
                                    <?php foreach ($dataJenisSatuan->getResult() as $data) { ?>
                                        <?php if (old('jenis_satuan') == $data->id_jenis_satuan) { ?>
                                            <option value="<?= $data->id_jenis_satuan ?>" selected><?= $data->nama_jenis_satuan ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $data->id_jenis_satuan ?>"><?= $data->nama_jenis_satuan ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Bahan</label>
                                <input type="number" id="harga_bahan" class="form-control <?= ($messageValidation->hasError('harga_bahan')) ? 'is-invalid' : '' ?>" name="harga_bahan" placeholder="Silahkan isi harga bahan" value="<?= old('harga_bahan') ?>">
                                <div class="invalid-feedback"><?= $messageValidation->getError('harga_bahan') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Stok Bahan</label>
                                <input type="number" id="stok_bahan" class="form-control <?= ($messageValidation->hasError('stok_bahan')) ? 'is-invalid' : '' ?>" name="stok_bahan" placeholder="Silahkan isi stok bahan" value="<?= old('stok_bahan') ?>">
                                <div class="invalid-feedback"><?= $messageValidation->getError('stok_bahan') ?></div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
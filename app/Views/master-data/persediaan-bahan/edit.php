<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Persediaan Bahan</h1>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <?php
                        $idBahan;
                        $namaBahan;
                        $hargaBahan;
                        $stokBahan;
                        $jenisSatuan;
                        foreach ($dataPersediaanBahan->getResult() as $data) {
                            $idBahan = $data->id_bahan;
                            $namaBahan = $data->nama_bahan;
                            $hargaBahan = $data->harga_bahan;
                            $stokBahan = $data->stok_bahan;
                            $jenisSatuan = $data->id_jenis_satuan;
                        }
                        ?>
                        <form action="<?= base_url('PersediaanBahan/update') ?>" method="POST">
                            <div class="card-header">
                                <h4>Silahkan isi form</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id_bahan" id="id_bahan" value="<?= $idBahan ?>">
                                <div class="form-group">
                                    <label>Nama Bahan</label>
                                    <input type="text" id="nama_bahan" class="form-control form-update-master-data <?= ($messageValidation->hasError('nama_bahan')) ? 'is-invalid' : '' ?>" name="nama_bahan" placeholder="Silahkan isi nama supplier" value="<?php if ($messageValidation->hasError('nama_bahan')) { ?> <?= old('nama_bahan') ?> <?php } elseif (!$messageValidation->hasError('nama_bahan')) { ?> <?php if (!old('nama_bahan')) { ?> <?= $namaBahan ?> <?php  } else { ?> <?= old('nama_bahan') ?> <?php } ?> <?php } ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('nama_bahan') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Satuan</label>
                                    <select id="jenis_satuan" name="jenis_satuan" class="form-control select2">
                                        <?php foreach ($dataJenisSatuan->getResult() as $data) { ?>
                                            <?php if ($jenisSatuan == $data->id_jenis_satuan) { ?>
                                                <option value="<?= $data->id_jenis_satuan ?>" selected><?= $data->nama_jenis_satuan ?></option>
                                            <?php } ?>
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
                                    <input type="text" id="harga_bahan" class="form-control form-update-master-data telepon-supplier <?= ($messageValidation->hasError('harga_bahan')) ? 'is-invalid' : '' ?>" name="harga_bahan" placeholder="Silahkan isi harga bahan" value="<?php if ($messageValidation->hasError('harga_bahan')) { ?> <?= old('harga_bahan') ?> <?php } elseif (!$messageValidation->hasError('harga_bahan')) { ?> <?php if (!old('harga_bahan')) { ?> <?= trim($hargaBahan) ?> <?php  } else { ?> <?= old('harga_bahan') ?> <?php } ?> <?php } ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('harga_bahan') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Stok Bahan</label>
                                    <input type="text" id="stok_bahan" class="form-control form-update-master-data telepon-supplier <?= ($messageValidation->hasError('stok_bahan')) ? 'is-invalid' : '' ?>" name="stok_bahan" placeholder="Silahkan isi stok bahan" value="<?php if ($messageValidation->hasError('stok_bahan')) { ?> <?= old('stok_bahan') ?> <?php } elseif (!$messageValidation->hasError('stok_bahan')) { ?> <?php if (!old('stok_bahan')) { ?> <?= trim($stokBahan) ?> <?php  } else { ?> <?= old('stok_bahan') ?> <?php } ?> <?php } ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('stok_bahan') ?></div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
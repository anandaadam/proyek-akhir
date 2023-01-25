<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Supplier</h1>
        </div>

        <div class="section-body">
            <div class="section-body">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <?php
                        $idSupplier;
                        $namaSupplier;
                        $teleponSupplier;
                        $alamatSupplier;
                        foreach ($dataSupplier->getResult() as $data) {
                            $idSupplier = $data->id_supplier;
                            $namaSupplier = $data->nama_supplier;
                            $teleponSupplier = $data->telepon_supplier;
                            $alamatSupplier = $data->alamat_supplier;
                        }
                        ?>
                        <form action="<?= base_url('Supplier/update') ?>" method="POST">
                            <div class="card-header">
                                <h4>Silahkan isi form</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id_supplier" id="id_supplier" value="<?= $idSupplier ?>">
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" id="nama_supplier" class="form-control form-update-master-data <?= ($messageValidation->hasError('nama_supplier')) ? 'is-invalid' : '' ?>" name="nama_supplier" placeholder="Silahkan isi nama supplier" value="<?php if ($messageValidation->hasError('nama_supplier')) { ?> <?= old('nama_supplier') ?> <?php } elseif (!$messageValidation->hasError('nama_supplier')) { ?> <?php if (!old('nama_supplier')) { ?> <?= $namaSupplier ?> <?php  } else { ?> <?= old('nama_supplier') ?> <?php } ?> <?php } ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('nama_supplier') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Telepon Supplier</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" id="telepon_supplier" name="telepon_supplier" class="form-control phone-number telepon-supplier form-update-master-data <?= ($messageValidation->hasError('telepon_supplier')) ? 'is-invalid' : '' ?>" name="telepon_supplier" placeholder="Silahkan isi telepon supplier" value="<?php if ($messageValidation->hasError('telepon_supplier')) { ?> <?= old('telepon_supplier') ?> <?php } elseif (!$messageValidation->hasError('telepon_supplier')) { ?> <?php if (!old('telepon_supplier')) { ?> <?= $teleponSupplier ?> <?php  } else { ?> <?= old('telepon_supplier') ?> <?php } ?> <?php } ?>" placeholder="Silahkan isi telepon supplier" value="<?= old('telepon_supplier') ?>" />
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Alamat Supplier</label>
                                    <textarea class="form-control form-update-master-data <?= ($messageValidation->hasError('alamat_supplier')) ? 'is-invalid' : '' ?>" name="alamat_supplier" id="alamat_supplier" data-height="100" placeholder="Silahkan isi alamat supplier">
                                    <?php if ($messageValidation->hasError('alamat_supplier')) { ?> <?= old('alamat_supplier') ?> <?php } elseif (!$messageValidation->hasError('alamat_supplier')) { ?> <?php if (!old('alamat_supplier')) { ?> <?= $alamatSupplier ?> <?php  } else { ?> <?= old('alamat_supplier') ?> <?php } ?> <?php } ?>
                                    </textarea>
                                    <div class="invalid-feedback"><?= $messageValidation->getError('alamat_supplier') ?></div>
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
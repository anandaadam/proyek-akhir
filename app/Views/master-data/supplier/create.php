<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Supplier</h1>
        </div>

        <div class="section-body">

            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <form action="<?= base_url('Supplier/store') ?>" method="POST">
                        <div class="card-header">
                            <h4>Silahkan isi form</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" id="nama_supplier" class="form-control <?= ($messageValidation->hasError('nama_supplier')) ? 'is-invalid' : '' ?>" name="nama_supplier" placeholder="Silahkan isi nama supplier" value="<?= old('nama_supplier') ?>">
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
                                    <input type="text" id="telepon_supplier" name="telepon_supplier" class="form-control phone-number  <?= ($messageValidation->hasError('telepon_supplier')) ? 'is-invalid' : '' ?>" placeholder="Silahkan isi telepon supplier" value="<?= old('telepon_supplier') ?>" />
                                </div>
                                <div class="invalid-feedback"><?= $messageValidation->getError('telepon_supplier') ?></div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Alamat Supplier</label>
                                <textarea class="form-control <?= ($messageValidation->hasError('alamat_supplier')) ? 'is-invalid' : '' ?>" name="alamat_supplier" id="alamat_supplier" rows="3" placeholder="Silahkan isi alamat supplier"><?= old('alamat_supplier') ?></textarea>
                                <div class="invalid-feedback"><?= $messageValidation->getError('alamat_supplier') ?></div>
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
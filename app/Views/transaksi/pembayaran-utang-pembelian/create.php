<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pembayaran Utang Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <form action="<?= base_url('PembayaranUtangPembelian/store/' . $idUtangPembelian) ?>" method="POST">
                        <div class="card-header">
                            <h4>Silahkan isi form</h4>
                        </div>
                        <input type="hidden" name="id_utang_pembelian" value="<?= $idUtangPembelian ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal Pembayaran</label>
                                <input type="text" name="tanggal_pembayaran" class="form-control datepicker <?= ($messageValidation->hasError('tanggal_pembayaran')) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_pembayaran') ?>">
                                <div class="invalid-feedback"><?= $messageValidation->getError('tanggal_pembayaran') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Pembayaran</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            $
                                        </div>
                                    </div>
                                    <input type="text" name="jumlah_pembayaran" class="form-control currency <?= ($messageValidation->hasError('jumlah_pembayaran')) ? 'is-invalid' : '' ?>" placeholder="Silahkan isi jumlah pembayaran" value="<?= old('jumlah_pembayaran') ?>">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('jumlah_pembayaran') ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catatan Transaksi</label>
                                <input type="text" id="catatan_transaksi" class="form-control <?= ($messageValidation->hasError('catatan_transaksi')) ? 'is-invalid' : '' ?>" name="catatan_transaksi" placeholder="Silahkan isi catatan transaksi" value="<?= old('catatan_transaksi') ?>">
                                <div class="invalid-feedback"><?= $messageValidation->getError('catatan_transaksi') ?></div>
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
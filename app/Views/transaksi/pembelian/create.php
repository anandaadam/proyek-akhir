<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">
                            <h4>Data Transaksi</h4>
                        </div> -->
                    <div class="card-body">
                        <?php
                        if (session()->has("success")) {
                        ?>
                            <div class="alert alert-primary alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <b><?= session("success"); ?></b>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <form action="<?= base_url('Pembelian/store') ?>" method="POST">
                            <div class="d-flex justify-content-between badges">
                                <h5 class="text-primary ">Data Transaksi</h5>
                                <a href="<?= base_url('Pembelian/index') ?>" class="badge badge-secondary">Lihat Daftar Transaksi</a>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="id_supplier">Supplier</label>
                                    <select id="id_supplier" name="id_supplier" class="form-control select2">
                                        <?php foreach ($dataSupplier->getResult() as $data) { ?>
                                            <option value="<?= $data->id_supplier ?>"><?= $data->nama_supplier ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Tanggal Pembelian</label>
                                    <input type="text" name="tanggal_pembelian" class="form-control datepicker">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="tipe_pembayaran">Tipe Pembayaran</label>
                                    <select id="tipe_pembayaran" name="tipe_pembayaran" class="form-control select2" required>
                                        <option disabled selected value>Pilih Pembayaran</option>
                                        <option value="kas">Kas</option>
                                        <option value="bri">Bank BRI</option>
                                        <option value="bni">Bank BNI</option>
                                        <option value="bca">Bank BCA</option>
                                        <option value="kredit">Kredit</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="catatan_transaksi">Catatan Transaksi</label>
                                    <input id="catatan_transaksi" type="text" class="form-control <?= ($messageValidation->hasError('catatan_transaksi')) ? 'is-invalid' : '' ?> catatan-transaksi" name="catatan_transaksi">
                                    <div class="invalid-feedback"><?= $messageValidation->getError('catatan_transaksi') ?></div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        <a href="" clas></a>
                    </div>
                </div>
            </div>
    </section>
</div>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Transaksi Retur Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
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
                    <?php if ($isNew) { ?>
                        <?php
                        $isExist = false;
                        $noPembelian;
                        $idSupplier;
                        $namaSupplier;
                        $tipePembayaran;
                        $tanggalPembelian; ?>
                        <?php foreach ($dataPembelian->getResult() as $data) {
                            $isExist = true;
                            $noPembelian = $data->no_transaksi_pembelian;
                            $idSupplier = $data->id_supplier;
                            $namaSupplier = $data->nama_supplier;
                            $tipePembayaran = $data->tipe_pembayaran;
                            $tanggalPembelian = $data->tanggal_pembelian;
                        } ?>
                        <?php if ($isExist) { ?>
                            <div class="card-body">
                                <form action="<?= base_url('ReturPembelian/store') ?>" method="POST">
                                    <div class="d-flex justify-content-between badges">
                                        <h5 class="text-primary ">Data Transaksi</h5>
                                        <a href="<?= base_url('ReturPembelian/create') ?>" class="badge badge-secondary">Change</a>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="nomor_pembelian" value="<?= $noPembelian ?>">
                                        <input type="hidden" name="id_supplier" value="<?= $idSupplier ?>">
                                        <input type="hidden" name="tipe_pembayaran" value="<?= $tipePembayaran ?>">
                                        <div class="form-group col-6">
                                            <label for="nama_supplier">Nama Supplier</label>
                                            <input id="nama_supplier" type="text" class="form-control <?= ($messageValidation->hasError('nama_supplier')) ? 'is-invalid' : '' ?> catatan-transaksi" name="nama_supplier" value="<?= $namaSupplier; ?>" disabled>
                                            <div class="invalid-feedback"><?= $messageValidation->getError('nama_supplier') ?></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Tanggal Pembelian</label>
                                            <input type="text" name="tanggal_pembelian" class="form-control datepicker" value="<?= $tanggalPembelian ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Tanggal Retur Pembelian</label>
                                            <input type="text" name="tanggal_retur_pembelian" class="form-control datepicker" value="<?= old('tanggal_retur_pembelian') ?>">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="catatan_transaksi">Catatan Transaksi</label>
                                            <input id="catatan_transaksi" type="text" value="<?= old('catatan_transaksi') ?>" class=" form-control <?= ($messageValidation->hasError('catatan_transaksi')) ? 'is-invalid' : '' ?> catatan-transaksi" name="catatan_transaksi">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('catatan_transaksi') ?></div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            <?php } elseif (!$isExist) { ?>
                                <div class="alert alert-primary alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <b>Data tidak ditemukan</b>
                                    </div>
                                </div>
                                <form action="<?= base_url('ReturPembelian/find') ?>" method="POST">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between badges">
                                            <h5 class="text-primary ">Data Transaksi</h5>
                                            <a href="<?= base_url('ReturPembelian/index') ?>" class="badge badge-secondary">Lihat Daftar Transaksi</a>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_pembelian">Nomor Pembelian</label>
                                            <input id="nomor_pembelian" type="text" class="form-control <?= ($messageValidation->hasError('nomor_pembelian')) ? 'is-invalid' : '' ?>" name="nomor_pembelian">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('nomor_pembelian') ?></div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" type="submit">Find</button>
                                        </div>
                                </form>
                            <?php } ?>
                        <?php } ?>
                        <?php if (!$isNew) { ?>
                            <form action="<?= base_url('ReturPembelian/find') ?>" method="POST">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between badges">
                                        <h5 class="text-primary ">Data Transaksi</h5>
                                        <a href="<?= base_url('ReturPembelian/index') ?>" class="badge badge-secondary">Lihat Daftar Transaksi</a>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_pembelian">Nomor Pembelian</label>
                                        <input id="nomor_pembelian" type="text" class="form-control <?= ($messageValidation->hasError('nomor_pembelian')) ? 'is-invalid' : '' ?>" name="nomor_pembelian">
                                        <div class="invalid-feedback"><?= $messageValidation->getError('nomor_pembelian') ?></div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit">Find</button>
                                    </div>
                            </form>
                        <?php } ?>
                            </div>
                </div>
            </div>

    </section>
</div>
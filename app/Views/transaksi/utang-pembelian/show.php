<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pembayaran Utang Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Jumlah Pembayaran</th>
                                            <th class="text-center">Tanggal Pembayaran</th>
                                            <!-- <th class="text-center">Tanggal Pembayaran</th> -->
                                            <!-- <th class="text-center">Tanggal Pembayaran</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataUtangPembelian->getResult() as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= number_to_currency($data->jumlah_pembayaran_utang_pembelian, 'IDR', 'id_ID', 2) ?></td>
                                                <td class="text-center"><?= $data->tanggal_pembayaran_utang_pembelian ?></td>
                                                <td class="text-center"><?= $data->tanggal_pembayaran_utang_pembelian ?></td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
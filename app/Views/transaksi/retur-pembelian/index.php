<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('ReturPembelian/create') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
                        </div>
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
                                            <th class="text-center">No. Transaksi</th>
                                            <th class="text-center">Supplier</th>
                                            <th class="text-center">Total Retur Pembelian</th>
                                            <th class="text-center">Tanggal Retur Pembelian</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataReturPembelian->getResult() as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $data->no_transaksi_retur_pembelian ?></td>
                                                <td class="text-center"><?= $data->nama_supplier ?></td>
                                                <td class="text-center"><?= number_to_currency($data->total_retur_pembelian, 'IDR', 'id_ID', 2) ?></td>
                                                <td class="text-center"><?= $data->tanggal_retur_pembelian ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('ReturPembelian/show/' . $data->no_transaksi_retur_pembelian) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
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
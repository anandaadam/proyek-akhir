<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Persediaan Bahan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('PersediaanBahan/create') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
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
                                            <th class="text-center">Nama Bahan</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Harga Bahan</th>
                                            <th class="text-center">Stok Bahan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataPersediaanBahan->getResult() as $data) { ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $data->nama_bahan ?></td>
                                                <td><?= $data->nama_jenis_satuan ?></td>
                                                <td><?= number_to_currency($data->harga_bahan, 'IDR', 'id_ID', 2) ?></td>
                                                <td><?= $data->stok_bahan ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('PersediaanBahan/edit/' . $data->id_bahan) ?>" class="btn btn-warning"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-remove-data" data-remove=<?= $data->id_bahan ?> data-confirm="Hapus?|Anda yakin untuk menghapus <b><?= $data->nama_bahan ?></b> dari daftar persediaan bahan?"><i class="fa fa-trash fa-xl"></i>
                                                    </button>
                                                    <form action="<?= base_url('PersediaanBahan/remove/' . $data->id_bahan) ?>" name="form<?= $data->id_bahan ?>" class="form<?= $data->id_bahan ?>" method="POST">
                                                    </form>
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
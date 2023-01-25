<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Supplier</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('Supplier/create') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
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
                                            <th class="text-center">Nama Supplier</th>
                                            <th class="text-center">Telepon Supplier</th>
                                            <th class="text-center">Alamat Supplier</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($dataSupplier->getResult() as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $data->nama_supplier ?></td>
                                                <td class="text-center"><?= $data->telepon_supplier ?></td>
                                                <td class="text-center"><?= $data->alamat_supplier ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Supplier/edit/' . $data->id_supplier) ?>" class="btn btn-warning"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-remove-data" data-remove=<?= $data->id_supplier ?> data-confirm="Hapus?|Anda yakin untuk menghapus <b><?= $data->nama_supplier ?></b> dari daftar supplier?"><i class="fa fa-trash fa-xl"></i>
                                                    </button>
                                                    <form action="<?= base_url('Supplier/remove/' . $data->id_supplier) ?>" name="form<?= $data->id_supplier ?>" class="form<?= $data->id_supplier ?>" method="POST">
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
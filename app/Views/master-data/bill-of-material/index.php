<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bill Of Material</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('BillOfMaterial/create') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
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
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($dataBillOfMaterial->getResult() as $data) { ?>
                                            <tr class="text-center">
                                                <td><?= $no; ?></td>
                                                <td><?= $data->nama_produk ?></td>
                                                <td>
                                                    <a href="<?= base_url('BillOfMaterial/create/' . $data->id_bom) ?>" class="btn btn-success"><i class="fas fa-plus"></i>
                                                    </a>
                                                    <a href="<?= base_url('BillOfMaterial/show/' . $data->id_bom) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= base_url('BillOfMaterial/edit/' . $data->id_bom) ?>" class="btn btn-warning"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('BillOfMaterial/delete/' . $data->id_bom) ?>" class="btn btn-danger"><i class="fas fa-trash fa-xl"></i>
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
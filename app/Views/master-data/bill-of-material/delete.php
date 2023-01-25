<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Hapus Data Bill Of Material</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="">Silahkan Pilih Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" id="nama_produk" class="form-control" name="nama_produk" value="<?= $namaProduk ?>" disabled>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Bahan</th>
                                    <th scope="col">Jumlah Bahan</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="tabel-bom">
                                <?php $no = 0;
                                foreach ($dataBom->getResult() as $data) {
                                    $no++; ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $data->nama_bahan ?></td>
                                        <td><?= $data->kuantitas ?></td>
                                        <td class="">
                                            <input class="form-check-input checkbox-item-bom" type="checkbox" id="defaultCheck1" data-checkbox="<?= $data->id_detail_bom ?>">
                                        </td>
                                    </tr>
                                <?php   } ?>
                            </tbody>
                        </table>

                        <div class="d-none container-input-bom">
                            <form action="<?= base_url('BillOfMaterial/remove/') ?>" class="form-hapus-item-bom" method="POST">
                                <input type="hidden" name="jumlah_bom" class="jumlah-bom" value="0">
                            </form>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger btn-remove-data" data-remove=<?= $idBom ?> data-confirm="Hapus?|Anda yakin untuk menghapus <b><?= $idBom ?></b> dari BOM?">Hapus Semua BOM
                            </button>
                            <form action="<?= base_url('BillOfMaterial/removeAll/' . $idBom) ?>" name="form<?= $idBom ?>" class="form<?= $idBom ?> d-none" method="POST">
                            </form>

                            <button class="btn btn-primary btn-remove-item-bom" data-remove=<?= $idBom ?> data-confirm="Hapus?|Anda yakin untuk menghapus <b><?= $idBom ?></b> dari BOM?">Submit
                            </button>
                            <div class="d-none btn-tambah-bahan-bom btn-submit-bom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
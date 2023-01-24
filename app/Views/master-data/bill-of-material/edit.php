<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bill Of Material</h1>
        </div>
        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Silahkan isi form</h4>
                    </div>
                    <form action="<?= base_url('BillOfMaterial/update') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" id="nama_produk" class="form-control" name="nama_produk" value="<?= $namaProduk ?>" disabled>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <tr>
                                    <th scope="col" style="width:5%">#</th>
                                    <th scope="col" style="width:50%">Nama Bahan</th>
                                    <th scope="col">Jumlah Bahan</th>
                                </tr>
                                </thead>
                                <tbody class="tabel-edit-bom">

                                    <input type="hidden" name="id_bom_update" value="<?= $idBom ?>">
                                    <?php $no = 0;
                                    foreach ($dataBom->getResult() as $data) {
                                        $no++
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <select id="bahan" name="bahan_bom_update<?= $no ?>" class="form-control select2 bahan-bom g-3">
                                                        <option selected value="<?= $data->id_bahan ?>"><?= $data->nama_bahan ?></option>
                                                        <?php foreach ($dataBahan->getResult() as $bahan) { ?>
                                                            <?php if ($data->id_bahan !== $bahan->id_bahan) { ?>
                                                                <option value="<?= $bahan->id_bahan ?>"><?= $bahan->nama_bahan ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" class="form-control" name="kuantitas_bom_update<?= $no ?>" value="<?= $data->kuantitas ?>"><input type="hidden" value="<?= $data->id_detail_bom ?>" name="id_detail_bom<?= $no ?>"></td>
                                        </tr>
                                    <?php  }  ?>
                                    <input type="hidden" name="jumlah_bom_update" value="<?= $no ?>">
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>
</section>
</div>
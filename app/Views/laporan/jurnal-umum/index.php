<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jurnal Umum</h1>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card p-3">
                    <form action="#" method="POST">
                        <h5 class="text-primary">Pilih Periode</h5>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="periode-tahun">Periode Tahun</label>
                                <select id="periode-tahun" name="periode_tahun" class="form-control select2 periode-tahun">
                                    <?php
                                    foreach ($dataTahun->getResult() as $data) { ?>
                                        <option value="<?= $data->tahun ?>"><?= $data->tahun ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="periode-bulan">Periode Bulan</label>
                                <select class="form-control select2 periode-bulan" name="periode_bulan" id="periode_bulan">
                                    <option value="01-Januari">Januari</option>
                                    <option value="02-Februari">Februari</option>
                                    <option value="03-Maret">Maret</option>
                                    <option value="04-April">April</option>
                                    <option value="05-Mei">Mei</option>
                                    <option value="06-Juni">Juni</option>
                                    <option value="07-Juli">Juli</option>
                                    <option value="08-Agustus">Agustus</option>
                                    <option value="09-September">September</option>
                                    <option value="10-Oktober">Oktober</option>
                                    <option value="11-November">November</option>
                                    <option value="12-Desember">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-jurnal-umum" type="button">Submit</button>
                        </div>
                    </form>
                    <h6 class="text-center text-success">Jurnal Umum</h6>
                    <h6 class="text-center text-primary">Polubi Snack</h6>
                    <h6 class="text-center text-danger periode-jurnal-umum">Periode</h6>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Debit</th>
                                    <th scope="col">Kredit</th>
                                </tr>
                            </thead>
                            <tbody class="tabel-jurnal-umum">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
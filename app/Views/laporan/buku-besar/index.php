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
                            <div class="form-group col-4">
                                <label for="periode-tahun">Periode Tahun</label>
                                <select id="periode-tahun" name="periode_tahun" class="form-control select2 periode-tahun">
                                    <?php foreach ($dataTahun->getResult() as $data) { ?>
                                        <option value="<?= $data->tahun ?>"><?= $data->tahun ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
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
                            <div class="form-group col-4">
                                <label for="kode-akun">Periode Tahun</label>
                                <select id="kode-akun" name="kode_akun" class="form-control select2 kode-akun">
                                    <!-- <option value="semua">Semua Akun</option> -->
                                    <?php foreach ($dataAkun->getResult() as $data) { ?>
                                        <option value="<?= $data->kode_akun ?>-<?= $data->nama_akun ?>"><?= $data->nama_akun ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-buku-besar" type="button">Submit</button>
                        </div>
                    </form>
                    <h6 class="text-center text-success">Buku Besar</h6>
                    <h6 class="text-center text-primary">Polubi Snack</h6>
                    <h6 class="text-center text-danger periode-buku-besar">Periode</h6>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-secondary">
                                    <th colspan="3" class="nama-akun-buku-besar"></th>
                                    <th colspan="4" style="text-align:right" class="kode-akun-buku-besar"></th>
                                </tr>
                                <tr class="table-secondary">
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2" style="text-align:center">Ref</th>
                                    <th rowspan="2" style="text-align:center">Debit</th>
                                    <th rowspan="2" style="text-align:center">Kredit</th>
                                    <th colspan="2" style="text-align:center">Saldo</th>
                                </tr>
                                <tr class="table-secondary">
                                    <th style="text-align:center">Debit</th>
                                    <th style="text-align:center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody class="tabel-buku-besar">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
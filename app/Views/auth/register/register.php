<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <!-- <div class="login-brand">
                            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div> -->

                        <div class="text-center mb-4">
                            <h1 class="text-primary">Register</h1>
                        </div>

                        <div class="card card-primary">
                            <div class="card-body">
                                <h5 class="text-center">Informasi Perusahaan</h5>
                                <form method="POST" action="<?= base_url('Register/register') ?>">
                                    <div class="form-group">
                                        <label for="nama_perusahaan">Nama Perusahaan</label>
                                        <input id="nama_perusahaan" type="text" class="form-control <?= ($messageValidation->hasError('nama_perusahaan')) ? 'is-invalid' : '' ?>" name="nama_perusahaan" placeholder="Silahkan isi nama perusahaan" value="<?= old('nama_perusahaan') ?>">
                                        <div class="invalid-feedback"><?= $messageValidation->getError('nama_perusahaan') ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="telepon_perusahaan">Telepon Perusahaan</label>
                                            <input id="telepon_perusahaan" type="number" class="form-control <?= ($messageValidation->hasError('telepon_perusahaan')) ? 'is-invalid' : '' ?>" name="telepon_perusahaan" placeholder="Silahkan isi telepon perusahaan" value="<?= old('telepon_perusahaan') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('telepon_perusahaan') ?></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email_perusahaan">Email Perusahaan</label>
                                            <input id="email_perusahaan" type="email" class="form-control <?= ($messageValidation->hasError('email_perusahaan')) ? 'is-invalid' : '' ?>" name="email_perusahaan" placeholder="Silahkan isi email perusahaan" value="<?= old('email_perusahaan') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('email_perusahaan') ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Perusahaan</label>
                                        <textarea class="form-control <?= ($messageValidation->hasError('alamat_perusahaan')) ? 'is-invalid' : '' ?>" name="alamat_perusahaan" id="alamat_perusahaan" data-height="100" placeholder="Silahkan isi alamat perusahaan"><?= old('alamat_perusahaan') ?></textarea>
                                        <div class="invalid-feedback"><?= $messageValidation->getError('alamat_perusahaan') ?></div>
                                    </div>
                                    <hr>
                                    <h5 class="text-center">Informasi Pengguna</h5>
                                    <div class="form-group">
                                        <label for="nama_pengguna">Nama Pengguna</label>
                                        <input id="nama_pengguna" type="text" class="form-control <?= ($messageValidation->hasError('nama_pengguna')) ? 'is-invalid' : '' ?>" name="nama_pengguna" placeholder="Silahkan isi nama pengguna" value="<?= old('nama_pengguna') ?>">
                                        <div class="invalid-feedback"><?= $messageValidation->getError('nama_pengguna') ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="telepon_pengguna">Telepon Pengguna</label>
                                            <input id="telepon_pengguna" type="number" class="form-control <?= ($messageValidation->hasError('telepon_pengguna')) ? 'is-invalid' : '' ?>" name="telepon_pengguna" placeholder="Silahkan isi telepon pengguna" value="<?= old('telepon_pengguna') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('telepon_pengguna') ?></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email_pengguna">Email Pengguna</label>
                                            <input id="email_pengguna" type="email" class="form-control <?= ($messageValidation->hasError('email_pengguna')) ? 'is-invalid' : '' ?>" name="email_pengguna" placeholder="Silahkan isi email pengguna" value="<?= old('email_pengguna') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('email_pengguna') ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe Pengguna</label>
                                        <select id="tipe_pengguna" name="tipe_pengguna" class="form-control select2">
                                            <?php foreach ($dataTipePengguna->getResult() as $data) { ?>
                                                <?php if (old('tipe_pengguna') == $data->id_tipe_pengguna) { ?>
                                                    <option value="<?= $data->id_tipe_pengguna ?>" selected><?= $data->nama_tipe_pengguna ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $data->id_tipe_pengguna ?>"><?= $data->nama_tipe_pengguna ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block ">Password</label>
                                            <input id="password" type="password" class="form-control <?= ($messageValidation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" value="<?= old('password') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('password') ?></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control <?= ($messageValidation->hasError('password_confirmation')) ? 'is-invalid' : '' ?>" name="password_confirmation" value="<?= old('password_confirmation') ?>">
                                            <div class="invalid-feedback"><?= $messageValidation->getError('password_confirmation') ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-muted text-center mb-5">
                            Sudah memiliki akun? <a href="<?= base_url('Login') ?>">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h3 class="pb-3"><?= $title; ?></h3>
    <div class="ro pb-3">
        <form action="<?= base_url('user/tambahAksi') ?>" method="POST">
            <form>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-4">
                        <input type="number" name="nik" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-2">
                        <input type="date" name="tanggal_lahir" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-form-label col-sm-2 pt-0">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="laki-laki" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2" value="perempuan">
                                <label class="form-check-label" for="gridRadios2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nomor Telpon</label>
                    <div class="col-sm-4">
                        <input type="number" name="no_telpon" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                        <input type="text" name="email" class="form-control" id="inputPassword3" placeholder="user@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-6">
                        <select id="inputState" name="agama" class="form-control col-md-3">
                            <option selected>Choose...</option>
                            <option>Islam</option>
                            <option>Kristen</option>
                            <option>Hindu</option>
                            <option>Budha</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-md-4">
                        <textarea rows="6" type="text" name="alamat" class="form-control" id="inputPassword3"></textarea>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="belum_kawin" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Belum Kawin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="kawin">
                                <label class="form-check-label" for="gridRadios2">
                                    Kawin
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-4">
                        <input type="text" name="kecamatan" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kelurahan</label>
                    <div class="col-sm-4">
                        <input type="text" name="kelurahan" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-4">
                        <input type="text" name="pekerjaan" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Bank Account</label>
                    <div class="col-sm-10">
                        <select id="inputState" name="bank" class="form-control col-md-3">
                            <option selected>Choose...</option>
                            <option>Bank Central Asia</option>
                            <option>Mandiri</option>
                            <option>CIMB Niaga</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">No Rekening</label>
                    <div class="col-sm-4">
                        <input type="number" name="no_rekening" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('user/nasabah') ?>" type="submit" class="btn btn-secondary">Batal</a>
            </form>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- End of Main Content -->
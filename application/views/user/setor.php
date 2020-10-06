<!-- Begin Page Content -->
<div class="container-fluid">

    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">

    <!-- Page Heading -->
    <h3><?= $title; ?></h3>
    <div class="row pb-4 mb-3">
        <div class="col pb-3">
            <table class="table">
                <form action="<?= base_url('user/tambahSetor') ?>" method="post">
                    <div class="form-group row">
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Nasabah</label>
                        <div class="col-sm-4">
                            <select name="namanasabah" class="form-control" required onchange="tampilRekening()" id="namaNasabah">
                                <option value="">-- Pilih Nasabah --</option>
                                <?php foreach ($nasabah as $nasabah) { ?>
                                    <option value="<?= $nasabah->id_user ?>"><?= $nasabah->nama ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-4">
                            <input type="norekening" readonly class="form-control" id="no_rek" value>
                        </div>
                    </div>
            </table>

            <table class="table">
                <thead>
                    <th style="width: 250px;">Jenis Sampah</th>
                    <th style="width: 230px;">Nama Sampah</th>
                    <th>Satuan</th>
                    <th>Harga Sampah</th>
                    <th>Jumlah (KG) </th>
                    <th>Sub Total</th>
                </thead>
                <tr>
                    <td>
                        <select id="namaSampah" name="jenis_sampah" class="form-control" onchange="tampilSampah()" required>
                            <option value="">-- Pilih Sampah --</option>
                            <?php foreach ($sampah as $sampah) { ?>
                                <option value="<?= $sampah->id_harga ?>"><?= $sampah->kategori ?></option>
                            <?php  } ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="nm_sampah" readonly name="nama_sampah" class="form-control">
                    </td>
                    <td>
                        <input type="text" id="st_sampah" readonly name="satuan" class="form-control">
                    </td>
                    <td>
                        <input type="text" id="hrg_sampah" readonly name="hargasampah" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="jumlah" class="form-control" id="jumlahSampah" required>
                    </td>
                    <td>
                        <input type="text" id="hasil" readonly name="subtotal" class="form-control">
                    </td>
                </tr>
            </table>
            <div class="col-md mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>

            </form>
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <th>No</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Sampah</th>
                    <th>Nama Sampah</th>
                    <th>Satuan</th>
                    <th>Harga Sampah</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($setor as $setor) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $setor->nama ?></td>
                            <td><?= $setor->kategori ?></td>
                            <td><?= $setor->jenis_sampah ?></td>
                            <td><?= $setor->satuan ?></td>
                            <td><?= $setor->harga ?></td>
                            <td><?= $setor->jumlah ?></td>
                            <td><?= $setor->sub_total ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class=""><?= $title; ?></h1>
    <!-- Page Heading -->

    <form action="">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-4">
                <label type="text" name="nama" class="form-control"><?= $user['nama']; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-4">
                <label type="text" name="alamat" class="form-control"><?= $user['alamat']; ?>
            </div>
        </div>
        <div class=" form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Rekening</label>
            <div class="col-sm-4">
                <label type="text" name="norekening" class="form-control"><?= $user['no_rekening']; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Saldo</label>
            <div class="col-sm-4">
                <label type="text" name="saldo" class="form-control"><?= $tb_setor['sub_total']; ?>
            </div>
        </div>
    </form>

    <table class="table table-bordered" id=" dataTable">
        <h3>Setoran Sampah</h3>
        <thead>
            <th>No</th>
            <th>Jenis Sampah</th>
            <th>Nama Sampah</th>
            <th>Satuan</th>
            <th>Harga Sampah</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- container-fluid -->

<!-- End of Main Content -->
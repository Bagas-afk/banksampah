<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class=""><?= $title; ?></h1>
    <!-- Page Heading -->


    <div class="card" style="max-width: 25rem;">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label class="card-title">Nama Lengkap</label>
                </div>
                <div class="col-sm-6">
                    <label class="card-title"><?= $user['nama']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="card-title">Email</label>
                </div>
                <div class="col-sm-6">
                    <label class="card-title"><?= $user['email']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="card-title">Nomor Telpon</label>
                </div>
                <div class="col-sm-6">
                    <label class="card-title"><?= $user['no_telpon']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="card-title">Alamat</label>
                </div>
                <div class="col-sm-6">
                    <label class="card-title"><?= $user['alamat']; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="card-title"> Bergabung sejak</label>
                </div>
                <div class="col-sm-6">
                    <label class="card-title"> <?= $user['date_created']; ?></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
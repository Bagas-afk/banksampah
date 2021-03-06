<!-- Begin Page Content -->
<div class="container-fluid">
    <h3><?= $title; ?></h3>

    <div class="row">
        <div class="col-md">
            <table class="table table-houver" id="dataTable">
                <thead class="table-dark">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Penarikan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tampilPenarikan as $tp) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tp->nama ?></td>
                            <td><?= $tp->jumlah_penarikan ?></td>
                            <td> <?= $tp->tanggal ?></td>
                            <td>
                                <a href="<?= base_url('user/verifPenarikan/') . $tp->id_transaksi ?>" class="btn btn-success"><i class="fas fa-check-square"> Verifikasi</i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Page Heading -->



</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
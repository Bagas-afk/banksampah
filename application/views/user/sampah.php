<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h3><?= $title; ?></h3>
    <div class="row">
        <div class="col">
            <table class="table" id="dataTable">
                <thead class="thead-dark">
                    <!-- Button trigger modal -->
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Tambah Jenis Sampah</button>
                            </div>
                            <div class="col-3">
                                <a href="<?= base_url('mpdfcontroller/printPDF') ?>" type="button" class="btn btn-danger mb-4">Export PDF</a>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <th scope=" col">No</th>
                        <th scope="col">Jenis Sampah</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_sampah as $sampah) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $sampah->jenis_sampah ?></td>
                            <td><?= $sampah->kategori ?></td>
                            <td>Rp. <?= $sampah->harga ?></td>
                            <td>/ <?= $sampah->satuan ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $sampah->id_harga ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $sampah->id_harga ?>"><i class="fas fa-trash"></i></button>
                            </td>

                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $sampah->id_harga ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit sampah <?= $sampah->jenis_sampah ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('user/editSampah') ?>" method="post">
                                            <div class="form-group">
                                                <label for="inputEmail4">Jenis Sampah</label>
                                                <input name="jenis_sampah" type="text" class="form-control" id="inputEmail4" value="<?= $sampah->jenis_sampah ?>">
                                            </div>
                                            <input name="id_harga" type="text" class="form-control" hidden id="inputEmail4" value="<?= encrypt_url($sampah->id_harga) ?>">
                                            <label for="inputEmail4">Kategori</label>
                                            <input name="kategori" type="text" readonly class="form-control" id="inputEmail4" value="<?= $sampah->kategori ?>">
                                            <label for="inputEmail4">Harga</label>
                                            <input name="harga" type="number" class="form-control" id="inputEmail4" value="<?= $sampah->harga ?>">
                                            <label for="inputEmail4">Satuan</label>
                                            <input name="satuan" type="text" class="form-control" id="inputEmail4" readonly value="<?= $sampah->satuan ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus-->
                        <div class="modal fade" id="hapusModal<?= $sampah->id_harga ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus sampah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda ingin menghapus <?= $sampah->jenis_sampah; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('user/hapusSampah/') . $sampah->id_harga ?>" class="btn btn-primary">Iya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>






<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/tambahSampah') ?>" method="post">
                <div class="modal-body">
                    <label for="inputEmail4">Jenis Sampah</label>
                    <input name="jenis_sampah" type="text" class="form-control" id="inputEmail4">
                    <div class="form-group">
                        <label for="inputState">Kategori</label>
                        <select name="kategori" id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>Kaca</option>
                            <option>Plastik</option>
                            <option>Besi</option>
                            <option>Kertas</option>
                        </select>
                    </div>
                    <label for="inputEmail4">Harga</label>
                    <input name="harga" type="text" class="form-control" id="inputEmail4">
                    <label for="inputEmail4">Satuan</label>
                    <input name="satuan" type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <table class="table" border=1>
            <thead>
                <tr>
                    <th scope=" col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jenis Sampah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Satuan</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($jenis_sampah as $sampah) { ?>
                    <tr>

                        <td><?= $no++ ?></td>
                        <td><?= $sampah->kategori ?></td>
                        <td><?= $sampah->jenis_sampah ?></td>
                        <td><?= $sampah->harga ?></td>
                        <td><?= $sampah->satuan ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
</div>
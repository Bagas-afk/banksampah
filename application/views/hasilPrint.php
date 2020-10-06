<table class="table">
    <thead class="">
        <div class="container">
            <tr>
                <th scope=" col">No</th>
                <th scope="col">Jenis Sampah</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Satuan</th>
                <th scope="col">Action</th>
            </tr>
        </div>
    </thead>
    <tbody>
        <?php
        print
            $no = 1;
        foreach ($data_sampah as $sampah) { ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $sampah->jenis_sampah ?></td>
                <td><?= $sampah->kategori ?></td>
                <td>Rp. <?= $sampah->harga ?></td>
                <td>/ <?= $sampah->satuan ?></td>
                <td>
            </tr>
        <?php } ?>
    </tbody>
</table>
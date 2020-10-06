<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class=""><?= $title; ?></h1>
  <!-- Page Heading -->

  <div class="card" style="width: 18rem;">
    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title" href="<?= base_url('nama') . $user['nama']; ?>"><?= $user['nama']; ?></h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
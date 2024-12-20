<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="row ">
    <!-- BOOKS -->
    <div class="col-lg-3 col-sm-6">
      <a href="<?= base_url('Buku'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-book"></i>
            </h2>
            <h3>
            <?= $Books; ?>  Buku
            </h3>
          </div>
        </div>
      </a>
    </div>
    <!-- BOOK STOCK -->
    <div class="col-lg-3 col-sm-6">
      <a href="<?= base_url('buku'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-clone"></i>
            </h2>
            <h3>
            <?= $stokBuku; ?>  Stok Buku
            </h3>
          </div>
        </div>
      </a>
    </div>
    <!-- RACKS -->
    <div class="col-lg-3 col-6">
      <a href="<?= base_url('Rak'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-th-list"></i>
            </h2>
            <h3>
            <?= $Racks; ?>  Rak Buku
            </h3>
          </div>
        </div>
      </a>
    </div>
    <!-- CATEGORIES -->
    <div class="col-lg-3 col-6">
      <a href="<?= base_url('Kategori'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-box-open"></i>
            </h2>
            <h3>
            <?= $Categories; ?>  Kategori
            </h3>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row my-4">
    <!-- MEMBER -->
    <div class="col-sm-6">
      <a href="<?= base_url('Anggota'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-users"></i>
            </h2>
            <h3>
            <?= $Members; ?>  Anggota
            </h3>
          </div>
        </div>
      </a>
    </div>
    <!-- LOANS -->
    <div class="col-sm-6">
      <a href="<?= base_url('Admin/pengajuanmasuk'); ?>">
        <div class="card">
          <div class="card-body">
            <h2>
              <i class="fas fa-handshake"></i>
            </h2>
            <h3>
            <?= $Loans; ?>  Transaksi Peminjaman
            </h3>
          </div>
        </div>
      </a>
    </div>
  </div>


</div>
<?= $this->endSection(); ?>
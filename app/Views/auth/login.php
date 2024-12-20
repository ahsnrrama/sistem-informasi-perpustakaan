<?= $this->extend('auth/index'); ?>

<?= $this->section('content'); ?>

  <div class="container vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="row mb-4">
        <div class="col text-center">
            <a href="<?= base_url(); ?>">
                <h1>E-PERPUSTAKAAN</h1>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3 d-flex justify-content-center">
            <div class="card bg-primary text-white" style="width: 18rem;">
                <div class="card-body d-flex">
                    <div class="me-3">
                        <h2 class="text-white">Admin</h2>
                        <p class="card-text">
                            Login untuk Admin
                        </p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-cube-alt' style="font-size: 100px; color: rgba(255, 255, 255, 0.3);"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('Auth/logUser'); ?>" class="btn btn-info">Klik untuk Login</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3 d-flex justify-content-center">
            <div class="card bg-info text-white" style="width: 18rem;">
                <div class="card-body d-flex">
                    <div class="me-3">
                        <h2 class="text-white">Anggota</h2>
                        <p class="card-text">
                            Login untuk Anggota
                        </p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-user' style="font-size: 100px; color: rgba(255, 255, 255, 0.3);"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('Auth/logAnggota'); ?>" class="btn btn-primary">Klik untuk Login</a>
                </div>
            </div>
        </div>
    </div>
  </div>
  <?= $this->endSection(); ?>
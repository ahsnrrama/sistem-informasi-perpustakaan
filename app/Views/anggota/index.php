<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Profile Anggota
    </h1>
    <?php if ($anggota['verifikasi'] == 1) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            Akun anda sudah Terverifikasi
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php else: ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            Akun anda belum Terverifikasi
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card card-shadow">
        <div class="card-header d-flex">
            <h5 class="card-title"><?= $judul; ?></h5>
            <div class="card-tools ms-auto">
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                    <i class='bx bx-plus'></i> Edit Profile
                </button>
            </div>
        </div>
        <!-- Account -->
        <div class="card-body d-flex ">

            <img
                src="<?= base_url('assets/foto/' . $anggota['foto']); ?>"
                alt="user-avatar"
                class="d-block rounded me-5"
                height="200"
                width="200"
                id="uploadedAvatar" />
            <table class="table table-bordered table-stripped">
                <tr>
                    <th width="200px">Nim</th>
                    <th width="50px">:</th>
                    <td><?= $anggota['nim']; ?></td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>:</th>
                    <td><?= $anggota['nama_mahasiswa']; ?></td>
                </tr>
                <tr>
                    <th>jenis Kelamin</th>
                    <th>:</th>
                    <td><?= $anggota['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <th>NO HandPhone</th>
                    <th>:</th>
                    <td><?= $anggota['no_hp']; ?></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <td><?= $anggota['nama_kelas']; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td><?= $anggota['alamat']; ?></td>
                </tr>
                <tr>
                    <th>Verifikasi</th>
                    <th>:</th>
                    <td>
                        <?php if ($anggota['verifikasi'] == 1) : ?>
                            <span class="badge bg-label-success">Terverifikasi</span>
                        <?php else: ?>
                            <span class="badge bg-label-danger">Belum Terverifikasi</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <!-- /Account -->
    </div>
</div>

<?php if (!empty($pendingPeminjaman)) : ?>
    <?php foreach ($pendingPeminjaman as $peminjaman) : ?>
        <div
            class="bs-toast toast fade show bg-warning"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            style="position: fixed; top: 20px; right: 20px; z-index: 999999;">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Pemberitahuan</div>
                <small><?= date('d-m-Y ', strtotime($peminjaman['tgl_bts_ambil'])); ?></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Peminjaman Anda sudah disetujui. Segera ambil buku tersebut di perpustakaan sebelum <strong><?= strftime('%e %B %Y', strtotime($peminjaman['tgl_bts_ambil'])); ?></strong>. Jika melewati batas waktu, peminjaman akan otomatis dibatalkan.
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>
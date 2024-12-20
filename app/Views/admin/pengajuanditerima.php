<?php $this->extend('templates/index') ?>

<?php $this->section('page-content') ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Pengajuan Diterima
    </h1>
    <div class="row g-4">

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible">
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php foreach ($peminjaman as $anggota) : ?>
            <div class="col-12">

                <div class="card h-100 ">
                    <!-- Account -->
                    <div class="card-body bg-success text-white rounded">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="<?= base_url('assets/foto/' . $anggota['foto']); ?>"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar" />
                            <div class="">
                                <p class="fs-3"><?= $anggota['nama_mahasiswa']; ?> (<?= $anggota['qty']; ?> Buku)</p>
                                <p><?= $anggota['nama_kelas']; ?></p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body h-100">
                        <div class="table-responsive ">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Cover</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Lama Pinjam</th>
                                        <th>Tanggal Tempo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $no = 1 + (5 * ($page - 1));
                                    foreach ($anggota['buku'] as $k) : ?>
                                        <tr class="">
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?=  date('d-m-Y', strtotime($k['tgl_pengajuan'])); ?></td>
                                            <td class="text-center"><img src="<?= base_url('assets/cover/' . $k['cover']); ?>" width="75px" height="75px" alt=""></td>
                                            <td class="text-center"><?= $k['judul_buku']; ?></td>
                                            <td class="text-center"><?=  date('d-m-Y', strtotime($k['tgl_pinjam'])); ?></td>
                                            <td class="text-center"><?= $k['lama_pinjam'] . ' Hari'; ?></td>
                                            <td class="text-center"><?=  date('d-m-Y', strtotime($k['tgl_harus_kembali'])); ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary d-flex align-items-center" href="<?= base_url('admin/PinjamBuku/' . $k['id_pinjam']); ?>">
                                                    <i class="fas fa-check me-2"></i>Pinjamkan
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<?php $this->endSection(); ?>
<?php $this->extend('templates/index') ?>

<?php $this->section('page-content') ?>
<div class="container-fluid flex-grow-1 container-p-y">
        <h1>
            Denda Buku
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
                    <div class="card-body bg-info text-white rounded">
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
                                        <th>Tanggal Pengembalian</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Tempo</th>
                                        <th>Keterlambatan</th>
                                        <th>Denda</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $no = 1 + (5 * ($page - 1));
                                    foreach ($anggota['buku'] as $k) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $k['tgl_kembali'] ? date('d-m-Y', strtotime($k['tgl_kembali'])) : '-'; ?></td>
                                            <td class="text-center"><?= $k['judul_buku']; ?></td>
                                            <td class="text-center"><?= date('d-m-Y', strtotime($k['tgl_pinjam'])); ?></td>
                                            <td class="text-center"><?= date('d-m-Y', strtotime($k['tgl_harus_kembali'])); ?></td>
                                            <td class="text-center"><?= $k['keterlambatan'] > 0 ? $k['keterlambatan'] . ' Hari' : 'Tidak Ada'; ?></td>
                                            <td class="text-center">Rp. <?= number_format($k['denda'], 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#ModalDetail<?= $k['id_pinjam']; ?>">
                                                    Detail
                                                </button>
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

<?php foreach ($peminjaman as $anggota) : ?>
    <?php foreach ($anggota['buku'] as $k) : ?>
        <!-- Modal Detail -->
        <div class="modal fade" id="ModalDetail<?= $k['id_pinjam']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%;">
                <div class="modal-content">
                    <div class="modal-header border pb-3 bg-info text-white rounded">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="<?= base_url('assets/foto/' . $anggota['foto']); ?>"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar" />
                            <div class="">
                                <p class="fs-3"><?= $anggota['nama_mahasiswa']; ?></p>
                                <p><?= $anggota['nama_kelas']; ?></p>
                            </div>
                        </div>
                        <hr class="my-0" />
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Cover</th>
                                        <th class="text-center" style="width: 900px;">Data Buku</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/cover/' . $k['cover']); ?>" width="125px" height="125px" alt="">
                                        </td>
                                        <td>
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <h5>
                                                    <?= $k['judul_buku']; ?>
                                                </h5>
                                                <hr class="my-2">
                                                <div class="col-6">
                                                    <b>Kategori : </b> <?= $k['nama_kategori']; ?> <br>
                                                    <b>Penulis : </b> <?= $k['nama_penulis']; ?><br>
                                                    <b>Penerbit : </b> <?= $k['nama_penerbit']; ?><br>
                                                    <b>Lokasi : </b> <?= $k['nama_rak']; ?> Lantai <?= $k['lantai_rak']; ?>
                                                </div>
                                                <div class="col-6">
                                                    <b>Halaman : </b> <?= $k['halaman']; ?> <br>
                                                    <b>Bahasa : </b> <?= $k['bahasa']; ?> <br>
                                                    <b>ISBN : </b> <?= $k['isbn']; ?> <br>
                                                    <b>Tahun : </b> <?= $k['tahun']; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No Pinjam</th>
                                        <th class="text-center">Peminjaman</th>
                                        <th class="text-center">Total Denda</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center"><?= $k['no_pinjam']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <b>Tanggal Pengajuan : </b> <?= date('d-m-Y', strtotime($k['tgl_pengajuan'])); ?> <br>
                                                    <b>Tanggal Pinjam : </b> <?= date('d-m-Y', strtotime($k['tgl_pinjam'])); ?><br>
                                                    <b>Lama Pinjam : </b> <?= $k['lama_pinjam'] . ' Hari'; ?><br>
                                                    <b>Tanggal Harus Kembali : </b> <?= date('d-m-Y', strtotime($k['tgl_harus_kembali'])); ?><br>
                                                </div>
                                                <div class="col-6">
                                                    <b>Tanggal Pengembalian : </b> <?= $k['tgl_kembali'] ? date('d-m-Y', strtotime($k['tgl_kembali'])) : '-'; ?> <br>
                                                    <b>Keterlambatan : </b> <?= $k['keterlambatan'] ? $k['keterlambatan'] . ' Hari' : 'Tidak ada'; ?><br>
                                                    <b>Denda Per Hari : </b> <?= 'Rp. ' . number_format($k['denda_perhari'], 0, ',', '.'); ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?= $k['denda'] ? 'Rp. ' . number_format($k['denda'], 0, ',', '.') : 'Tidak Ada'; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $k['status_pinjam'] == 'tepat' ? 'bg-primary' : 'bg-warning'; ?>"><?= $k['status_pinjam']; ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End Detail -->
    <?php endforeach; ?>
<?php endforeach; ?>


<?php $this->endSection(); ?>
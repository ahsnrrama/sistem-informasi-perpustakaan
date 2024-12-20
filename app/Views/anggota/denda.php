<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Denda Buku
    </h1>
    <div class="card shadow">
        <div class="card-header d-flex">
            <h4 class="card-title">Data <?= $judul; ?></h4>

        </div>
        <div class="card-body">
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
                        foreach ($peminjaman as $k) : ?>
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

    </div>
</div>

<!-- Modal Detail -->
<?php
foreach ($peminjaman as $k) : ?>
    <div class="modal fade" id="ModalDetail<?= $k['id_pinjam']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header border pb-3 ">
                    <h5 class="modal-title" id="exampleModalLabel2">Detail <?= $judul; ?></h5>
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
                                        <img src="<?= base_url('assets/cover/' . $k['cover']); ?>" width="125px" height="125px" alt=""><br>
                                        <p><?= $k['kode_buku']; ?></p>
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
<?php endforeach; ?>
<!-- Modal End Detail -->


<script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
<?= $this->endSection(); ?>
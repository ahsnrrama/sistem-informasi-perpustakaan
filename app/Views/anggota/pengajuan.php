<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Pengajuan Peminjaman Buku
    </h1>
    <div class="card shadow">
        <div class="card-header d-flex">
            <h4 class="card-title">Data <?= $judul; ?></h4>
            <div class="card-tools ms-auto">
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                    <i class='bx bx-plus'></i> Add Pengajuan
                </button>
            </div>

        </div>
        <div class="card-body">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th class="text-center">No Pinjam</th>
                            <th class="text-center">Cover</th>
                            <th class="text-center" style="width: 400px;">Data Buku</th>
                            <th class="text-center">Peminjaman</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = 1 + (5 * ($page - 1));
                        foreach ($peminjaman as $k) : ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td><?= $k['no_pinjam']; ?></td>
                                <td class="text-center">
                                    <img src="<?= base_url('assets/cover/' . $k['cover']); ?>" width="125px" height="125px" alt="">
                                    <p><?= $k['kode_buku']; ?></p>
                                </td>
                                <td>
                                    <h5>
                                        <?= $k['judul_buku']; ?>
                                    </h5>
                                    <p>
                                        <b>Kategori : </b> <?= $k['nama_kategori']; ?> <br>
                                        <b>Penulis : </b> <?= $k['nama_penulis']; ?><br>
                                        <b>Penerbit : </b> <?= $k['nama_penerbit']; ?><br>
                                        <b>Lokasi : </b> <?= $k['nama_rak']; ?> Lantai <?= $k['lantai_rak']; ?> <br>
                                        <b>Halaman : </b> <?= $k['halaman']; ?> <br>
                                        <b>Bahasa : </b> <?= $k['bahasa']; ?> <br>
                                        <b>ISBN : </b> <?= $k['isbn']; ?> <br>
                                        <b>Tahun : </b> <?= $k['tahun']; ?> <br>
                                    </p>
                                </td>
                                <td>
                                    <b>Tanggal Pengajuan : </b> <?= date('d-m-Y', strtotime($k['tgl_pengajuan'])); ?> <br>
                                    <b>Tanggal Pinjam : </b> <?= date('d-m-Y', strtotime($k['tgl_pinjam'])); ?><br>
                                    <b>Lama Pinjam : </b> <?= $k['lama_pinjam'] . ' Minggu'; ?><br>
                                    <b>Tanggal Harus Kembali : </b> <?= date('d-m-Y', strtotime($k['tgl_harus_kembali'])); ?><br>
                                </td>
                                <td>
                                    <span class="badge bg-warning"><?= $k['status_pinjam']; ?></span>
                                </td>
                                <td>
                                    <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $k['id_pinjam']; ?>"><i class="bx bx-trash me-1"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('default', 'pagination'); ?>
            </div>

        </div>
    </div>
</div>

<!-- Modal ADD -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-m modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border pb-3">
                <h5 class="modal-title" id="exampleModalLabel2">Tambah <?= $judul; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('peminjaman/add'); ?>" method="post">
                <?= csrf_field(); ?>

                <!-- Menampilkan error jika ada -->
                <?php $errors = session()->getFlashdata('errors'); ?>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <?php
                $id_anggota = session()->get('id_anggota');
                $tgl = date('YmdHi');
                $no_pinjam = $tgl . '-' . '00' . $id_anggota;
                ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="no_pinjam">No Pinjam</label>
                        <input class="form-control" type="text" id="no_pinjam" name="no_pinjam" value="<?= $no_pinjam; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="buku" class="form-label">Judul Buku</label>
                        <select class="form-select select2 <?= isset($errors['id_buku']) ? 'is-invalid' : ''; ?>" id="buku" name="id_buku">
                            <option value="" disabled <?= old('id_buku') === null ? 'selected' : ''; ?>>Pilih buku</option>
                            <?php foreach ($listbuku as $b): ?>
                                <option value="<?= $b['id_buku']; ?>" <?= old('id_buku') == $b['id_buku'] ? 'selected' : ''; ?>><?= $b['judul_buku']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= isset($errors['id_buku']) ? $errors['id_buku'] : ''; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="html5-date-input" class="form-label">Tanggal Pinjam</label>
                        <input class="form-control" type="date" name="tgl_pinjam" value="<?= date('Y-m-d'); ?>" id="tanggal_pinjam" />
                    </div>

                    <div class="mb-3">
                        <label for="lama_pinjam" class="form-label">Lama Pinjam</label>
                        <div class="input-group">
                            <select name="lama_pinjam" id="lama_pinjam" class="form-control <?= isset($errors['lama_pinjam']) ? 'is-invalid' : ''; ?>">
                                <option value="" selected disabled >Maks 1 Bulan</option>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('lama_pinjam') == $i ? 'selected' : ''; ?>><?= $i ?> Minggu</option>
                                <?php endfor; ?>
                            </select>
                            <span class="input-group-text rounded-end">Minggu</span>
                            <div class="invalid-feedback">
                                <?= isset($errors['lama_pinjam']) ? $errors['lama_pinjam'] : ''; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="html5-date-input" class="form-label">Tanggal Harus Kembali</label>
                        <input class="form-control" type="date" value="" id="tgl_harus_kembali" name="tgl_harus_kembali" readonly />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Modal ADD -->

<!-- Modal Delete -->
<?php foreach ($peminjaman as $k): ?>
    <div class="modal fade" id="ModalDelete<?= $k['id_pinjam']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Peminjaman buku <strong><?= $k['judul_buku']; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="<?= base_url('peminjaman/delete/' . $k['id_pinjam']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal endDelete -->


<script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>/assets/select2/js/select2.full.min.js"></script>
<script>
    //Initialize Select2 Elements
    $('.select2').select2({
        dropdownParent: $('#ModalAdd'),
        theme: 'bootstrap4'
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<script>
    // menghitung otomatis tanggal harus kembali
    document.getElementById('lama_pinjam').addEventListener('input', function() {
        const lamaPinjam = parseInt(this.value);

        // Ambil tanggal pinjam dari input jika ada
        const tglPinjamInput = document.getElementById('tanggal_pinjam');
        const tglPinjam = new Date(tglPinjamInput.value); // Menggunakan nilai dari input tanggal pinjam

        // Jika input tanggal pinjam tidak valid, gunakan hari ini
        if (isNaN(tglPinjam.getTime())) {
            tglPinjam.setDate(new Date().getDate()); // Set ke hari ini jika tanggal pinjam tidak valid
        }

        // Hitung tanggal harus kembali
        tglPinjam.setDate(tglPinjam.getDate() + (lamaPinjam * 7));

        // Update input tanggal harus kembali
        const tglHarusKembaliInput = document.getElementById('tgl_harus_kembali');
        tglHarusKembaliInput.value = tglPinjam.toISOString().split('T')[0];
    });

    // memunculkan kembali modal ketika ada yang errors
    $(document).ready(function() {
        // Jika ada error di flashdata
        <?php if (session()->getFlashdata('errors')): ?>
            $('#ModalAdd').modal('show');
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>
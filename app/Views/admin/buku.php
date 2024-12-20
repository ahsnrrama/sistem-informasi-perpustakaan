<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        buku
    </h1>
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Data <?= $judul; ?></h4>
            <div class="d-flex">
                <div class="card-tools">
                    <form action="<?= base_url('buku'); ?>" method="post">
                        <div class="d-flex">
                            <input type="search" name="keyword" class="form-control me-2" aria-label="search" placeholder="search" id="">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                        </div>
                    </form>
                </div>
                <div class="card-tools ms-auto">
                    <button type="button" class="btn btn-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                        <i class='bx bx-plus'></i> Add
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">

            <?php

            use PhpParser\Node\Expr\Isset_;

            if (session()->getFlashdata('pesan')) : ?>
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
                            <th>Cover</th>
                            <th style="width: 400px;">Judul Buku</th>
                            <th>ISBN</th>
                            <th>Tahun</th>
                            <th>Bahasa</th>
                            <th style="width: 150px;">Jumlah</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = 1 + (5 * ($page - 1));
                        foreach ($buku as $k) : ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
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
                                        <b>Lokasi : </b> <?= $k['nama_rak']; ?> Lantai <?= $k['lantai_rak']; ?>
                                    </p>
                                </td>
                                <td><?= $k['isbn']; ?></td>
                                <td><?= $k['tahun']; ?></td>
                                <td><?= $k['bahasa']; ?></td>
                                <td>
                                    total : <span class="badge bg-success"><?= $k['jumlah']; ?></span> <br>
                                    tersedia : <span class="badge bg-primary"><?= $k['jml_tersedia']; ?></span> <br>
                                    dipinjam : <span class="badge bg-warning"><?= $k['jml_dipinjam']; ?></span>
                                </td>
                                <td>
                                    <div class="dropdown ">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $k['id_buku']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $k['id_buku']; ?>"><i class="bx bx-trash me-1"></i> Delete</button>
                                        </div>
                                    </div>
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

<!-- Modal Add Buku -->
<div class="modal fade" id="ModalAdd" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ModalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border pb-3">
                <h5 class="modal-title" id="ModalAddLabel">Tambah <?= $judul; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('buku/store'); ?>" method="post" enctype="multipart/form-data">
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

                    <div class="mb-3">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control <?= isset($errors['judul_buku']) ? 'is-invalid' : ''; ?>" id="judul_buku" name="judul_buku" value="<?= old('judul_buku'); ?>">
                        <div class="invalid-feedback">
                            <?= isset($errors['judul_buku']) ? $errors['judul_buku'] : ''; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control <?= isset($errors['isbn']) ? 'is-invalid' : ''; ?>" id="isbn" name="isbn" value="<?= old('isbn'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['isbn']) ? $errors['isbn'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control <?= isset($errors['tahun']) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['tahun']) ? $errors['tahun'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <label for="bahasa" class="form-label">Bahasa</label>
                            <input type="text" class="form-control <?= isset($errors['bahasa']) ? 'is-invalid' : ''; ?>" id="bahasa" name="bahasa" value="<?= old('bahasa'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['bahasa']) ? $errors['bahasa'] : ''; ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control <?= isset($errors['jumlah']) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['jumlah']) ? $errors['jumlah'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select <?= isset($errors['id_kategori']) ? 'is-invalid' : ''; ?>" id="kategori" name="id_kategori">
                                <option value="" disabled <?= old('id_kategori') === null ? 'selected' : ''; ?>>Pilih Kategori</option>
                                <?php foreach ($buku as $kat): ?>
                                    <option value="<?= $kat['id_kategori']; ?>" <?= old('id_kategori') == $kat['id_kategori'] ? 'selected' : ''; ?>><?= $kat['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['id_kategori']) ? $errors['id_kategori'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="lokasi" class="form-label">Lokasi Rak</label>
                            <select class="form-select <?= isset($errors['id_rak']) ? 'is-invalid' : ''; ?>" id="lokasi" name="id_rak">
                                <option value="" disabled <?= old('id_rak') === null ? 'selected' : ''; ?>>Pilih Lokasi Rak</option>
                                <?php foreach ($buku as $rak): ?>
                                    <option value="<?= $rak['id_rak']; ?>" <?= old('id_rak') == $rak['id_rak'] ? 'selected' : ''; ?>>
                                        <?= $rak['nama_rak']; ?> Lantai <?= $rak['lantai_rak']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['id_rak']) ? $errors['id_rak'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <select class="form-select <?= isset($errors['id_penerbit']) ? 'is-invalid' : ''; ?>" id="penerbit" name="id_penerbit">
                                <option value="" disabled <?= old('id_penerbit') === null ? 'selected' : ''; ?>>Pilih Penerbit</option>
                                <?php foreach ($buku as $pen): ?>
                                    <option value="<?= $pen['id_penerbit']; ?>" <?= old('id_penerbit') == $pen['id_penerbit'] ? 'selected' : ''; ?>><?= $pen['nama_penerbit']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['id_penerbit']) ? $errors['id_penerbit'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="penulis" class="form-label">Penulis</label>
                            <select class="form-select <?= isset($errors['id_penulis']) ? 'is-invalid' : ''; ?>" id="penulis" name="id_penulis">
                                <option value="" disabled <?= old('id_penulis') === null ? 'selected' : ''; ?>>Pilih Penulis</option>
                                <?php foreach ($buku as $pen): ?>
                                    <option value="<?= $pen['id_penulis']; ?>" <?= old('id_penulis') == $pen['id_penulis'] ? 'selected' : ''; ?>><?= $pen['nama_penulis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['id_penulis']) ? $errors['id_penulis'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea name="deskripsi" class="form-control <?= isset($errors['deskripsi']) ? 'is-invalid' : ''; ?>" value="<?= old('deskripsi'); ?>" id="summernote"></textarea>
                        <div class="invalid-feedback">
                            <?= isset($errors['deskripsi']) ? $errors['deskripsi'] : ''; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Cover</label>
                        <input type="file" class="form-control <?= isset($errors['cover']) ? 'is-invalid' : ''; ?>" id="cover" name="cover" onchange="previewImage(event,'new')">
                        <div class="invalid-feedback">
                            <?= isset($errors['cover']) ? $errors['cover'] : ''; ?>
                        </div>
                        <img id="previewNew" src="" alt="Preview cover" class="img-thumbnail mt-2" style="display: none; max-width: 150px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal endAdd Buku -->

<!-- Modal Edit Buku -->
<?php foreach ($buku as $k) : ?>
    <div class="modal fade" id="ModalEdit<?= $k['id_buku'] ?>" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ModalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border pb-3">
                    <h5 class="modal-title" id="ModalAddLabel">Edit <?= $judul; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('buku/update'); ?>" method="post" enctype="multipart/form-data">
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

                        <input type="hidden" name="id_buku" value="<?= $k['id_buku']; ?>">

                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control <?= isset($errors['judul_buku']) ? 'is-invalid' : ''; ?>" id="judul_buku" name="judul_buku" value="<?= old('judul_buku', $k['judul_buku']); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['judul_buku']) ? $errors['judul_buku'] : ''; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control <?= isset($errors['isbn']) ? 'is-invalid' : ''; ?>" id="isbn" name="isbn" value="<?= old('isbn', $k['isbn']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['isbn']) ? $errors['isbn'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control <?= isset($errors['tahun']) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun', $k['tahun']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['tahun']) ? $errors['tahun'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <label for="bahasa" class="form-label">Bahasa</label>
                                <input type="text" class="form-control <?= isset($errors['bahasa']) ? 'is-invalid' : ''; ?>" id="bahasa" name="bahasa" value="<?= old('bahasa', $k['bahasa']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['bahasa']) ? $errors['bahasa'] : ''; ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control <?= isset($errors['jumlah']) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah', $k['jumlah']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['jumlah']) ? $errors['jumlah'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select <?= isset($errors['id_kategori']) ? 'is-invalid' : ''; ?>" id="kategori" name="id_kategori">
                                    <option value="" disabled <?= old('id_kategori', $k['id_kategori']) === null ? 'selected' : ''; ?>>Pilih Kategori</option>
                                    <?php foreach ($buku as $kat): ?>
                                        <option value="<?= $kat['id_kategori']; ?>" <?= old('id_kategori', $k['id_kategori']) == $kat['id_kategori'] ? 'selected' : ''; ?>><?= $kat['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['id_kategori']) ? $errors['id_kategori'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="lokasi" class="form-label">Lokasi Rak</label>
                                <select class="form-select <?= isset($errors['id_rak']) ? 'is-invalid' : ''; ?>" id="lokasi" name="id_rak">
                                    <option value="" disabled <?= empty(old('id_rak', $k['id_rak'])) ? 'selected' : ''; ?>>Pilih Lokasi Rak</option>
                                    <?php foreach ($buku as $r): ?>
                                        <option value="<?= $r['id_rak']; ?>" <?= old('id_rak', $k['id_rak']) == $r['id_rak'] ? 'selected' : ''; ?>>
                                            <?= $r['nama_rak']; ?> Lantai <?= $r['lantai_rak']; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['id_rak']) ? $errors['id_rak'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <select class="form-select <?= isset($errors['id_penerbit']) ? 'is-invalid' : ''; ?>" id="penerbit" name="id_penerbit">
                                    <option value="" disabled <?= old('id_penerbit', $k['id_penerbit']) === null ? 'selected' : ''; ?>>Pilih Penerbit</option>
                                    <?php foreach ($buku as $pen): ?>
                                        <option value="<?= $pen['id_penerbit']; ?>" <?= old('id_penerbit', $k['id_penerbit']) == $pen['id_penerbit'] ? 'selected' : ''; ?>><?= $pen['nama_penerbit']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['id_penerbit']) ? $errors['id_penerbit'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="penulis" class="form-label">Penulis</label>
                                <select class="form-select <?= isset($errors['id_penulis']) ? 'is-invalid' : ''; ?>" id="penulis" name="id_penulis">
                                    <option value="" disabled <?= old('id_penulis', $k['id_penulis']) === null ? 'selected' : ''; ?>>Pilih Penulis</option>
                                    <?php foreach ($buku as $pen): ?>
                                        <option value="<?= $pen['id_penulis']; ?>" <?= old('id_penulis', $k['id_penulis']) == $pen['id_penulis'] ? 'selected' : ''; ?>><?= $pen['nama_penulis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['id_penulis']) ? $errors['id_penulis'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea id="summernote" name="deskripsi" class="form-control <?= isset($errors['deskripsi']) ? 'is-invalid' : ''; ?>"><?= old('deskripsi', $k['deskripsi']); ?></textarea>
                            <div class="invalid-feedback">
                                <?= isset($errors['deskripsi']) ? $errors['deskripsi'] : ''; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="file" class="form-control <?= isset($errors['cover']) ? 'is-invalid' : ''; ?>" id="cover" name="cover" onchange="previewImage(event,<?= $k['id_buku']; ?>)">
                            <div class="invalid-feedback">
                                <?= isset($errors['cover']) ? $errors['cover'] : ''; ?>
                            </div>
                            <img id="preview<?= $k['id_buku'] ?>" src="<?= base_url('assets/cover/' . $k['cover']); ?>" alt="Preview cover" class="img-thumbnail mt-2" style="max-width: 150px;" <?= !empty($k['cover']) ? '' : 'style="display: none;'; ?>>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal endedit Buku -->

<!-- Modal Delete -->
<?php foreach ($buku as $k): ?>
    <div class="modal fade" id="ModalDelete<?= $k['id_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus buku <strong><?= $k['judul_buku']; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="<?= base_url('buku/delete/' . $k['id_buku']) ?>" method="post">
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
<script>
    function previewImage(event, id) {
        const preview = document.getElementById('preview' + (id === 'new' ? 'New' : id));
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result; // Ganti dengan gambar baru
            preview.style.display = 'block'; // Tampilkan gambar
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = ''; // Jika tidak ada file, set src kosong
            preview.style.display = 'none'; // Sembunyikan gambar
        }
    }


    $(document).ready(function() {
        // Jika ada error di flashdata
        <?php if (session()->getFlashdata('errors')): ?>
            <?php if (session()->getFlashdata('isEdit')): ?>
                // Ambil ID anggota dari session
                var idBuku = '<?= session()->getFlashdata('id_buku') ?>';
                $('#ModalEdit' + idBuku).modal('show');
            <?php else: ?>
                $('#ModalAdd').modal('show');
            <?php endif; ?>
        <?php endif; ?>
    });

    $(document).ready(function() {
        // Fungsi untuk inisialisasi Summernote
        function initializeSummernote(modalId) {
            $(modalId).on('shown.bs.modal', function() {
                $(modalId).find('#summernote').summernote({
                    height: 100, // Sesuaikan tinggi editor
                    tabsize: 2
                });
            });
    
            // Destroy Summernote saat modal ditutup
            $(modalId).on('hidden.bs.modal', function() {
                $(modalId).find('#summernote').summernote('destroy');
            });
        }
    
        // Inisialisasi Summernote untuk modal Add Buku
        initializeSummernote('#ModalAdd');
    
        // Inisialisasi Summernote untuk setiap modal Edit Buku
        <?php foreach ($buku as $k) : ?>
            initializeSummernote('#ModalEdit<?= $k['id_buku'] ?>');
        <?php endforeach; ?>
    });
</script>

<?= $this->endSection(); ?>
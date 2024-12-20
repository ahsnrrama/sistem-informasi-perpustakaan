<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Anggota
    </h1>
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Data <?= $judul; ?></h4>
            <div class="d-flex">
                <div class="card-tools">
                    <form action="<?= base_url('anggota'); ?>" method="post">
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

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th>Nim</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>No HP</th>
                            <th>Password</th>
                            <th>Foto</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = 1 + (5 * ($page - 1));
                        foreach ($anggota as $k) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $k['nim']; ?></td>
                                <td><?= $k['nama_mahasiswa']; ?><br>
                                    <?php if ($k['verifikasi'] == 1) : ?>
                                        <a style="font-size: small;" class="text-success"><i class="fa fa-check"></i> Terverifikasi</a>
                                    <?php else : ?>
                                        <a style="font-size: small;" class="text-danger"><i class="fa fa-times"></i> Belum Terverifikasi</a><br>
                                        <button type="button" class="btn btn-success btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#Modalver">
                                            verifikasi
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td><?= $k['jenis_kelamin']; ?></td>
                                <td><?= $k['nama_kelas']; ?></td>
                                <td><?= $k['no_hp']; ?></td>
                                <td><?= substr($k['password'], 0, 20) . '...'; ?></td>
                                <td class="text-center"><img src="<?= base_url('assets/foto/' . $k['foto']); ?>" alt="" width="75px" height="75px"></td>
                                <td>
                                    <div class="dropdown ">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $k['id_anggota']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $k['id_anggota']; ?>"><i class="bx bx-trash me-1"></i> Delete</button>
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

<!-- Modal Verifikasi -->
<div class="modal fade" id="Modalver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Verifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memverifikasi anggota ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="<?= base_url('anggota/verifikasi/' . $k['id_anggota']) ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Anggota -->
<div class="modal fade" id="ModalAdd" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('anggota/store') ?>" method="post" enctype="multipart/form-data">
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

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" class="form-control <?= isset($errors['nama_mahasiswa']) ? 'is-invalid' : ''; ?>" value="<?= old('nama_mahasiswa'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['nama_mahasiswa']) ? $errors['nama_mahasiswa'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['email']) ? $errors['email'] : ''; ?>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" name="nim" id="nim" class="form-control <?= isset($errors['nim']) ? 'is-invalid' : ''; ?>" value="<?= old('nim'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['nim']) ? $errors['nim'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="no_hp" class="form-label">No Handphone</label>
                            <input type="text" class="form-control <?= isset($errors['no_hp']) ? 'is-invalid' : ''; ?>" id="no_hp" value="<?= old('no_hp'); ?>" name="no_hp">
                            <div class="invalid-feedback">
                                <?= isset($errors['no_hp']) ? $errors['no_hp'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select <?= isset($errors['id_kelas']) ? 'is-invalid' : ''; ?>" id="kelas" name="id_kelas">
                                <option value="" disabled <?= old('id_kelas') === null ? 'selected' : ''; ?>>Pilih Kelas</option>
                                <?php foreach ($kelas as $kat): ?>
                                    <option value="<?= $kat['id_kelas']; ?>" <?= old('id_kelas') == $kat['id_kelas'] ? 'selected' : ''; ?>>
                                        <?= $kat['nama_kelas']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['id_kelas']) ? $errors['id_kelas'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select <?= isset($errors['jenis_kelamin']) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" disabled <?= old('jenis_kelamin') === null ? 'selected' : ''; ?>>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['jenis_kelamin']) ? $errors['jenis_kelamin'] : ''; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control  <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['alamat']) ? $errors['alamat'] : ''; ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['password']) ? $errors['password'] : ''; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control <?= isset($errors['foto']) ? 'is-invalid' : ''; ?>" onchange="previewImage(event,'new')">
                        <div class="invalid-feedback">
                            <?= isset($errors['foto']) ? $errors['foto'] : ''; ?>
                        </div>
                        <img id="previewNew" src="" alt="Preview Foto" class="img-thumbnail mt-2" style="display: none; max-width: 100px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal endAdd anggota -->

<!-- Modal Edit Anggota -->
<?php foreach ($anggota as $k) : ?>
    <div class="modal fade" id="ModalEdit<?= $k['id_anggota'] ?>" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('anggota/update') ?>" method="post" enctype="multipart/form-data">
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

                        <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $k['id_anggota']; ?>">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                                <input type="text" name="nama_mahasiswa" class="form-control <?= isset($errors['nama_mahasiswa']) ? 'is-invalid' : ''; ?>" value="<?= old('nama_mahasiswa', $k['nama_mahasiswa']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['nama_mahasiswa']) ? $errors['nama_mahasiswa'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">E-Mail</label>
                                <input type="email" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?= old('email', $k['email']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['email']) ? $errors['email'] : ''; ?>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control <?= isset($errors['nim']) ? 'is-invalid' : ''; ?>" value="<?= old('nim', $k['nim']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['nim']) ? $errors['nim'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="no_hp" class="form-label">No Handphone</label>
                                <input type="text" class="form-control <?= isset($errors['no_hp']) ? 'is-invalid' : ''; ?>" id="no_hp" value="<?= old('no_hp', $k['no_hp']); ?>" name="no_hp">
                                <div class="invalid-feedback">
                                    <?= isset($errors['no_hp']) ? $errors['no_hp'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-select <?= isset($errors['id_kelas']) ? 'is-invalid' : ''; ?>" id="kelas" name="id_kelas">
                                    <option value="" disabled <?= old('id_kelas', $k['id_kelas']) === null ? 'selected' : ''; ?>>Pilih Kelas</option>
                                    <?php foreach ($kelas as $kat): ?>
                                        <option value="<?= $kat['id_kelas']; ?>" <?= old('id_kelas', $k['id_kelas']) == $kat['id_kelas'] ? 'selected' : ''; ?>>
                                            <?= $kat['nama_kelas']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['id_kelas']) ? $errors['id_kelas'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select <?= isset($errors['jenis_kelamin']) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="" disabled <?= old('jenis_kelamin', $k['jenis_kelamin']) === null ? 'selected' : ''; ?>>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?= old('jenis_kelamin', $k['jenis_kelamin']) == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= old('jenis_kelamin', $k['jenis_kelamin']) == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['jenis_kelamin']) ? $errors['jenis_kelamin'] : ''; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control  <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat', $k['alamat']); ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['alamat']) ? $errors['alamat'] : ''; ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password', $k['password']); ?>" disabled>
                                <div class="invalid-feedback">
                                    <?= isset($errors['password']) ? $errors['password'] : ''; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control <?= isset($errors['foto']) ? 'is-invalid' : ''; ?>" onchange="previewImage(event,<?= $k['id_anggota'] ?>)">
                            <div class="invalid-feedback">
                                <?= isset($errors['foto']) ? $errors['foto'] : ''; ?>
                            </div>
                            <img id="preview<?= $k['id_anggota'] ?>" src="<?= base_url('assets/foto/' . $k['foto']); ?>" alt="Preview Foto" class="img-thumbnail mt-2" style=" max-width: 100px;" <?= !empty($k['foto']) ? '' : 'style="display: none;'; ?>>
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal endEdit Anggota -->


<!-- Modal Delete -->
<?php foreach ($anggota as $k): ?>
    <div class="modal fade" id="ModalDelete<?= $k['id_anggota']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus anggota <strong><?= $k['nama_mahasiswa']; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="<?= base_url('anggota/delete/' . $k['id_anggota']) ?>" method="post">
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
                var idAnggota = '<?= session()->getFlashdata('id_anggota') ?>';
                $('#ModalEdit' + idAnggota).modal('show');
            <?php else: ?>
                $('#ModalAdd').modal('show');
            <?php endif; ?>
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>
<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Rak
    </h1>
    <div class="card shadow">
        <div class="card-header d-flex">
            <h4 class="card-title">Data <?= $judul; ?></h4>
            <div class="card-tools ms-auto">
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                    <i class='bx bx-plus'></i> Add
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

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th class="text-center">Nama Rak</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = 1 + (7 * ($page - 1));
                        foreach ($rak as $k) : ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $k['nama_rak']; ?> Lantai <?= $k['lantai_rak']; ?>
                                </td>
                                <td>
                                    <div class="dropdown ">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $k['id_rak']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $k['id_rak']; ?>"><i class="bx bx-trash me-1"></i> Delete</button>
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

<!-- Modal ADD -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border pb-3">
                <h5 class="modal-title" id="exampleModalLabel2">Tambah <?= $judul; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Rak/Add')) ?>
                <div class="form-group mb-3">
                    <label for="nama_rak" class="form-label">Nama Rak</label>
                    <input type="text" id="nama_rak" name="nama_rak" class="form-control" placeholder="Masukan Nama Rak" required />
                </div>
                <div class="form-group mb-3">
                    <label for="lantai_rak" class="form-label">lantai Rak</label>
                    <input type="number" id="lantai_rak" name="lantai_rak" class="form-control" placeholder="Masukan Lantai Rak" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- end Modal ADD -->

<!-- Modal Edit -->
<?php foreach ($rak as $k) : ?>
    <div class="modal fade" id="ModalEdit<?= $k['id_rak']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border pb-3">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit <?= $judul; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Rak/Edit/' . $k['id_rak'])) ?>
                    <div class="form_group mb-3">
                        <label for="nama_rak" class="form-label">Nama Rak</label>
                        <input type="text" id="nama_rak" name="nama_rak" value="<?= $k['nama_rak']; ?>" class="form-control" placeholder="Masukan Nama Rak" />
                    </div>
                    <div class="form_group mb-3">
                        <label for="lantai_rak" class="form-label">Lantai Rak</label>
                        <input type="text" id="lantai_rak" name="lantai_rak" value="<?= $k['lantai_rak']; ?>" class="form-control" placeholder="Masukan lantai Rak" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end Modal edit -->

<!-- Modal delete -->
<?php foreach ($rak as $k) : ?>
    <div class="modal fade" id="ModalDelete<?= $k['id_rak']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border pb-3">
                    <h5 class="modal-title" id="exampleModalLabel2">Hapus <?= $judul; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Rak/Delete/' . $k['id_rak'])) ?>
                    <p>Apakah kamu yakin akan menghapus data <b><?= $k['nama_rak']; ?> Lantai <?= $k['lantai_rak']; ?></b> ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" href="<?= base_url('Rak/Delete'); ?>" class="btn btn-danger">Hapus</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end Modal delete -->

<?= $this->endSection(); ?>
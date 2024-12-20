<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
        Kategori
    </h1>
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Data <?= $judul; ?></h4>
            <div class="d-flex">
                <div class="card-tools">
                    <?php echo form_open(base_url('Kategori')) ?>
                         <div class="d-flex">
                            <input type="search" name="keyword" class="form-control me-2" aria-label="search" placeholder="search" id="">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Search</button>
                        </div>
                    <?php echo form_close() ?>
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
                            <th>Kategori</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $no = 1 + (7 * ($page - 1));
                        foreach ($kategori as $k) : ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $k['nama_kategori']; ?>
                                </td>
                                <td>
                                    <div class="dropdown ">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $k['id_kategori']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#ModalDelete<?= $k['id_kategori']; ?>"><i class="bx bx-trash me-1"></i> Delete</button>
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
                <?php echo form_open(base_url('Kategori/Add')) ?>
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Masukan Nama Kategori" />
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
<?php foreach ($kategori as $k) : ?>
    <div class="modal fade" id="ModalEdit<?= $k['id_kategori']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border pb-3">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit <?= $judul; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Kategori/Edit/' . $k['id_kategori'])) ?>
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" value="<?= $k['nama_kategori']; ?>" class="form-control" placeholder="Masukan Nama Kategori" />
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
<?php foreach ($kategori as $k) : ?>
    <div class="modal fade" id="ModalDelete<?= $k['id_kategori']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border pb-3">
                    <h5 class="modal-title" id="exampleModalLabel2">Hapus <?= $judul; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Kategori/Delete/' . $k['id_kategori'])) ?>
                    <p>Apakah kamu yakin akan menghapus data <b><?= $k['nama_kategori']; ?></b> ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" href="<?= base_url('Kategori/Delete'); ?>" class="btn btn-danger">Hapus</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end Modal delete -->

<?= $this->endSection(); ?>
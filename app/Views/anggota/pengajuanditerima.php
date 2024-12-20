<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <h1>
       Pengajuan Peminjaman Buku Diterima
    </h1>
    <div class="card shadow">
        <div class="card-header d-flex">
            <h4 class="card-title">Data <?= $judul; ?></h4>

        </div>
        <div class="card-body">

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
                                    <b>Lama Pinjam : </b> <?= $k['lama_pinjam'].' Hari'; ?><br>
                                    <b>Tanggal Harus Kembali : </b> <?= date('d-m-Y', strtotime($k['tgl_harus_kembali'])); ?><br>
                                </td>
                                <td>
                                    <span class="badge bg-success"><?= $k['status_pinjam']; ?></span>
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


<script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
<?= $this->endSection(); ?>
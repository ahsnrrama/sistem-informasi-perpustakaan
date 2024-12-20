<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <?php if (session()->get('level') == 'anggota') : ?>
                            <img src="<?= base_url('assets/foto/' . $anggota['foto']); ?>" alt class="w-px-40 h-auto rounded-circle" />
                        <?php elseif (session()->get('level') == 'admin') : ?>
                            <img src="<?= base_url(); ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        <?php endif; ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <?php if (session()->get('level') == 'anggota') : ?>
                                            <img src="<?= base_url('assets/foto/' . $anggota['foto']); ?>" alt class="w-px-40 h-auto rounded-circle" />
                                        <?php else : ?>
                                            <img src="<?= base_url(); ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <!-- Cek level pengguna -->
                                    <?php if (session()->get('level') == 'admin') : ?>
                                        <!-- Tampilkan username jika levelnya admin -->
                                        <span class="fw-semibold d-block"><?= session()->get('username'); ?></span>
                                        <small class="text-muted">Admin</small>
                                    <?php elseif (session()->get('level') == 'anggota') : ?>
                                        <!-- Tampilkan nama mahasiswa jika levelnya anggota -->
                                        <span class="fw-semibold d-block"><?= session()->get('nama_mahasiswa'); ?></span>
                                        <small class="text-muted">Anggota</small>
                                    <?php else: ?>
                                        <!-- Jika level tidak diketahui -->
                                        <span class="fw-semibold d-block">Guest</span>
                                        <small class="text-muted">Unknown</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <?php if (session()->get('level') == 'anggota') : ?>
                            <a class="dropdown-item" href="<?= base_url('DashboardAnggota'); ?>">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        <?php else: ?>
                            <a class="dropdown-item" href="<?= base_url('/'); ?>">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <?php if (session()->get('level') == 'admin') : ?>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (session()->get('level') == 'anggota') : ?>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('Auth/logoutAnggota'); ?>">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
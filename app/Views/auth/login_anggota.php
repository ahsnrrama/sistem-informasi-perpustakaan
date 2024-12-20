<?= $this->extend('auth/index'); ?>


<?= $this->section('content'); ?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner ">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <h3 class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder">LOGIN Anggota</span>
                        </h3>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to
                        <a href="<?= base_url(); ?>">Perpustakaan! 👋</a>
                    </h4>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>
                    <?php
                    // notifikasi
                    $errors = session()->getFlashdata('errors');
                    if (!empty($errors)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <?php foreach ($errors as $key => $errors) : ?>
                                    <li>
                                        <?= esc($errors); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>

                    <form id="formAuthentication" class="mb-3" action="<?= base_url('auth/CekLogAnggota'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Enter your Nim" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="<?= base_url('auth/register'); ?>">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
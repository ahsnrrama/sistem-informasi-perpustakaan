<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================
* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)
========================================================= -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
  data-theme="theme-default" data-assets-path="<?= base_url(); ?>/assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>SIP | <?= $judul; ?></title>
  <meta name="description" content="" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/fonts/boxicons.css" />

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/demo.css" />

  <!-- summernote -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Helpers -->
  <script src="<?= base_url(); ?>/assets/vendor/js/helpers.js"></script>

  <!-- Config: Mandatory theme config file contain global vars & default theme options -->
  <script src="<?= base_url(); ?>/assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Sidebar -->
      <?= $this->include('templates/sidebar'); ?>
      <!-- / Sidebar -->

      <!-- Layout page -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('templates/topbar'); ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <?= $this->renderSection('page-content'); ?>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Ahsanu Rohmatika Taqwa</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- / Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/js/bootstrap.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url(); ?>/assets/select2/js/select2.full.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/js/menu.js"></script>
  <script src="<?= base_url(); ?>/assets/js/main.js"></script>

  <!-- include summernote css/js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

  <!-- GitHub Buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
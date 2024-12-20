<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-Library | <?= $judul; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/img/favicon/favicon.ico" />
    <link href="<?= base_url('Arsha'); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('Arsha'); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('Arsha'); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('Arsha'); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('Arsha'); ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('Arsha'); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('Arsha'); ?>/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="portfolio-details-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="<?= base_url('/'); ?>" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">E-Library</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?= base_url(''); ?>">Home</a></li>
                    <li><a href="<?= base_url('/'); ?> #about">About</a></li>
                    <li><a href="<?= base_url('/'); ?> #services">Services</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php if (session()->get('level') == 'admin') : ?>
                <a class="btn-getstarted" href="<?= base_url('admin'); ?>">Dashboard</a>
            <?php elseif (session()->get('level') == 'anggota') : ?>
                <a class="btn-getstarted" href="<?= base_url('dashboardAnggota'); ?>">Dashboard</a>
            <?php else: ?>
                <a class="btn-getstarted" href="<?= base_url('auth'); ?>">Login</a>
            <?php endif; ?>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="<?= base_url(''); ?>">Home</a></li>
                        <li class="current">Book Details</li>
                    </ol>
                </nav>
                <h1>Detail Buku</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="portfolio-details-slider">

                            <div class="align-items-center">
                                <img src="<?= base_url('assets/cover/' . $book['cover']); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                            <h3>Informasi Buku</h3>
                            <div class="row">
                                <div class="col-6">
                                    <ul>
                                        <li><strong>Kode Buku</strong> : <?= $book['kode_buku']; ?></li>
                                        <li><strong>Judul Buku</strong> : <?= $book['judul_buku']; ?></li>
                                        <li><strong>Kategori</strong> : <?= $book['nama_kategori']; ?></li>
                                        <li><strong>Penerbit</strong> : <?= $book['nama_penerbit']; ?></li>
                                        <li><strong>Penulis</strong> : <?= $book['nama_penulis']; ?></li>
                                        <li><strong>Rak</strong> : <?= $book['nama_rak']; ?> Lantai <?= $book['lantai_rak']; ?></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul>
                                        <li><strong>Bahasa</strong> : <?= $book['bahasa']; ?></li>
                                        <li><strong>Tahun</strong> : <?= $book['tahun']; ?></li>
                                        <li><strong>Halaman</strong> : <?= $book['halaman']; ?></li>
                                        <li><strong>Jumlah</strong> : <?= $book['jumlah']; ?></li>
                                        <li><strong>ISBN</strong> : <?= $book['isbn']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                            <h2><?= $book['judul_buku']; ?></h2>
                            <p>
                                <?php if (!empty($book['deskrispi'])) : ?>
                                    <?= $book['deskripsi']; ?>
                                <?php else : ?>
                                    "Buku Sakti Pemrograman Web" adalah buku panduan yang dirancang khusus untuk membantu pembaca menguasai berbagai aspek pemrograman web dari nol hingga mahir. Buku ini mencakup semua elemen penting dalam pengembangan web, mulai dari dasar-dasar seperti HTML, CSS, dan JavaScript, hingga topik lebih lanjut seperti penggunaan framework modern, pembuatan API, dan pengelolaan database.

                                    Buku ini ditulis dengan gaya yang mudah dipahami oleh pemula, namun juga kaya akan tips dan trik yang bermanfaat bagi para developer berpengalaman. Dengan "Buku Sakti Pemrograman Web," pembaca diharapkan mampu membuat aplikasi web interaktif, aman, dan siap untuk di-deploy ke server dalam waktu singkat.
                                <?php endif; ?>

                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Portfolio Details Section -->

    </main>

    <footer id="footer" class="footer">


        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Arsha</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Arsha</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('Arsha'); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('Arsha'); ?>/assets/js/main.js"></script>

</body>

</html>
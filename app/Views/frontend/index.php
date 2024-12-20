<?= $this->extend('frontend/templates'); ?>

<?= $this->Section('isi-konten'); ?>
<style>
  .text-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    /* Batasi hingga 2 baris */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
        <h1>Wujudkan Pengetahuan Tanpa Batas</h1>
        <p>Akses ribuan buku, jurnal, dan referensi langsung dari perangkat Anda, di mana saja, kapan saja.</p>
        <div class="d-flex">
          <a href="#about" class="btn-get-started">Mulai Membaca</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="<?= base_url(''); ?>/assets/img/hand-book.png" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>

</section><!-- /Hero Section -->

<!-- Advance search -->
<div class="container position-relative zindex-5" style="margin-top: -6rem;">
  <div class="rounded-3 py-4 px-3 px-sm-4 px-lg-0 shadow" style="background-color: aliceblue;">
    <div class="row align-items-center justify-content-center pt-1 pb-2 py-lg-4">
      <div class="col-lg-11 col-md-11">
        <div class="card border-0 shadow-sm p-sm-2">
          <form method="POST" action="" class="card-body needs-validation"
            novalidate="">
            <input name="advance_search" value="true" type="hidden">
            <div class="row">
              <div class="col-lg-9">
                <input type="text" id="keyword" name="keyword"
                  class="form-control form-control-lg"
                  placeholder="Ketik kata kunci pencarian">
                <div class="invalid-feedback">Silahkan masukkan kata kunci pencarian!</div>
              </div>
              <div class="col-lg-3">
                <div class="d-flex justify-content-center">
                  <!-- submit button -->
                  <button type="submit"
                    class=" btn shadow btn-lg w-75" style="background-color:lightskyblue; color:white;">
                    <i class="fas fa-search"></i>
                    Cari
                  </button>
                  <!-- end submit button -->
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Advance end search -->



<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Tentang Kami</h2>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">

      <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
        <p>
          Perpustakaan kami adalah sumber daya pengetahuan yang komprehensif, yang dirancang untuk mendukung pendidikan, penelitian, dan pengembangan literasi di masyarakat. Kami menyediakan akses mudah ke ribuan buku, jurnal, dan karya ilmiah lainnya dalam berbagai bidang.
        </p>
        <ul>
          <li><i class="bi bi-check2-circle"></i> <span>Akses koleksi literatur digital dan fisik kapan saja, di mana saja.</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>Program pendidikan dan pelatihan literasi untuk meningkatkan wawasan dan keterampilan.</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>Fasilitas dan layanan terbaik untuk mendukung penelitian akademis dan umum.</span></li>
        </ul>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <p>
          Misi kami adalah menyediakan akses terbuka ke pengetahuan, mendukung pembelajaran sepanjang hayat, dan menjadi pusat informasi yang terpercaya bagi semua kalangan. Kami terus berinovasi untuk memastikan bahwa layanan kami dapat memenuhi kebutuhan masyarakat di era digital ini.
        </p>
        <a href="#" class="read-more"><span>Pelajari Lebih Lanjut</span><i class="bi bi-arrow-right"></i></a>
      </div>

    </div>
  </div>

</section>

<!-- Kategori Section -->
<section id="categories" class="services section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Kategori Buku</h2>
    <p>Temukan koleksi buku kami yang beragam sesuai dengan minat dan kebutuhan Anda.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-book icon"></i></div>
          <h4><a href="link-to-fiction-category" class="stretched-link">Fiksi</a></h4>
          <p>Beragam novel dan cerita fiksi dari penulis terkenal dan terbaru.</p>
        </div>
      </div><!-- End Kategori Item -->

      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-journal-text icon"></i></div>
          <h4><a href="link-to-non-fiction-category" class="stretched-link">Non-Fiksi</a></h4>
          <p>Buku-buku inspiratif dan edukatif yang membahas berbagai topik.</p>
        </div>
      </div><!-- End Kategori Item -->

      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-person icon"></i></div>
          <h4><a href="link-to-biography-category" class="stretched-link">Biografi</a></h4>
          <p>Cerita hidup tokoh-tokoh terkenal yang menginspirasi.</p>
        </div>
      </div><!-- End Kategori Item -->

      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-brush icon"></i></div>
          <h4><a href="link-to-art-category" class="stretched-link">Seni & Desain</a></h4>
          <p>Koleksi buku seni dan desain untuk para penggemar dan profesional.</p>
        </div>
      </div><!-- End Kategori Item -->

    </div>

  </div>

</section><!-- /Kategori Section -->


<!-- kelebihan kami -->
<section id="services" class="section why-us white-background" data-builder="section">
  <div class="container-fluid">
    <div class="row gy-4">
      <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">
        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
          <h3><span>Kelebihan Kami </span><strong>Menjadikan Perpustakaan Anda Lebih Baik</strong></h3>
          <p>
            Kami memberikan akses tak terbatas ke berbagai koleksi digital dan fisik, serta layanan terbaik yang dirancang untuk memudahkan pencarian informasi dan pembelajaran.
          </p>
        </div>
        <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
          <div class="faq-item faq-active">
            <h3><span>01</span> Bagaimana cara mengakses koleksi buku digital?</h3>
            <div class="faq-content">
              <p>Anda dapat mengakses koleksi buku digital kami dengan membuat akun di situs kami. Setelah terdaftar, Anda bisa meminjam buku secara online dan membacanya langsung dari perangkat Anda.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>
          <div class="faq-item">
            <h3><span>02</span> Apa saja layanan yang tersedia di perpustakaan ini?</h3>
            <div class="faq-content">
              <p>Kami menyediakan layanan peminjaman buku fisik dan digital, ruang baca, akses jurnal ilmiah, serta program pelatihan literasi untuk berbagai kelompok usia.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>
          <div class="faq-item">
            <h3><span>03</span> Bagaimana cara mengikuti program literasi atau pelatihan?</h3>
            <div class="faq-content">
              <p>Program literasi dan pelatihan dapat diikuti dengan mendaftar melalui situs kami. Kami menyediakan berbagai kelas, mulai dari penggunaan teknologi perpustakaan hingga pelatihan riset dan penulisan ilmiah.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 why-us-img">
        <img src="<?= base_url('Arsha'); ?>/assets/img/why-us.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
      </div>
    </div>
  </div>
</section><!-- /Why Us Section -->


<!-- buku Section -->
<section id="buku" class="section testimonials light-background" data-builder="section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Buku teratas</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
      <div class="swiper-wrapper">
        <?php
        // Membagi array $books menjadi grup berisi 3 item
        $chunks = array_chunk($books, 3);
        foreach ($chunks as $chunk): ?>
          <div class="swiper-slide">
            <div class="row">
              <?php foreach ($chunk as $book) : ?>
                <div class="col-4">
                  <div class="card " style="height:600px">
                    <img class="card-img-top" height="350px" src="<?= base_url('assets/cover/' . $book['cover']); ?>" alt="Card image cap" />
                    <div class="card-body">
                      <p class="fw-light"><?= $book['tahun']; ?></p>
                      <a href="<?= base_url('Home/detail/' . $book['id_buku']); ?>" class="" style="color: black;">
                        <h4 class="card-title text-clamp" style="height: 60px;"><?= $book['judul_buku']; ?></h4>
                      </a>
                      <hr>
                      <h5 class="fw-bold"><?= $book['nama_penulis']; ?></h5>
                      <p><?= $book['nama_penerbit']; ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div><!-- End testimonial item -->
        <?php endforeach; ?>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  </div>

</section><!-- /Testimonials Section -->

<?= $this->endSection(); ?>
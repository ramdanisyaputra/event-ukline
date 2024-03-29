<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UKLINE EVENT </title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <link rel="icon" href="{{asset('logo/logo.svg')}}" type="image/png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landing/assets_landing_akm/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing/assets_landing_akm/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('landing/assets_landing_akm/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('landing/assets_landing_akm/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('landing/assets_landing_akm/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing/assets_landing_akm/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('landing/assets_landing_akm/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.2.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center">
        <img src="{{asset('logo/logo.svg')}}" alt="">
        <span>UKLINE EVENT</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Aplikasi Ujian Daring</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Telah digunakan oleh ratusan sekolah di Indonesia</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="{{route('login')}}" class="btn-get-started scrollto d-inline-flex py-4 align-items-center justify-content-center align-self-center">
                <span>Masuk</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{asset('landing/assets_landing_akm/img/hero-img.png')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2>UKLINE EVENTS</h2>
              <div class="text-center text-lg-start">
                <p>Dunia pendidikan sudah mulai terbiasa dengan pembelajaran jarak jauh atau daring, peserta didik pun sudah terbiasa belajar dengan menggunakan aplikasi.</p>
                <p>Hal ini dapat dikatakan bahwa dunia pendidikan Indonesia sudah mampu menggunakan berbagai aplikasi 4.0.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{url('landing/assets_landing_akm/img/un1.jpg')}}" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Keunggulan & Manfaat</h2>
          <p>UKLINE EVENTS</p>
        </header>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
              <img src="{{asset('landing/assets_landing_akm/img/values-1.png')}}" class="img-fluid" alt="">
              <h3>Akses Mudah</h3>
              <p>Semua fitur yang dimiliki oleh UKline terpusat dalam satu server yang membuat aplikasi mudah diakses<p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="400">
              <img src="{{asset('landing/assets_landing_akm/img/values-2.png')}}" class="img-fluid" alt="">
              <h3>Biaya Terjangkau</h3>
              <p>Dengan menggunakan UKline Event, Anda cukup membayar fitur yang digunakan</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="600">
              <img src="{{asset('landing/assets_landing_akm/img/values-3.png')}}" class="img-fluid" alt="">
              <h3>Fleksibilitas Waktu</h3>
              <p>Anda dapat mengerjakan soal pada fitur yang telah dipilih dengan waktu yang fleksibel</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Lebih mudah dan terorganisir</h2>
          <p>Fitur Aplikasi UKLINE EVENTS</p>
        </header>

        <div class="row">

          <div class="col-lg-6">
            <img src="{{asset('landing/assets_landing_akm/img/features.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
            <div class="row align-self-center gy-4">

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Tryout AKM</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>PAS</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>PTS</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>TOEFL</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Tryout SBMPTN</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Tryout STAN</h3>
                </div>
              </div>

            </div>
          </div>

        </div> <!-- / row -->
      </div>

    </section><!-- End Features Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Pertanyaan yang sering ditanyakan</h2>
          <p>FAQ UKLINE EVENTS</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    Bagaimana cara akses UKLINE EVENT ? 
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Caranya mudah cukup ketik event.ukline.id di browser anda
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    Bagaimana cara saya login ?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Cukup klik login pada halaman ini lalu masukan username dan password
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    Bagaimana saya mengerjakan ujian ?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Cukup Login masukan username dan password, setelah itu anda akan diarahkan ke pilihan ujian lalu pilih ujian yang akan anda kerjakan
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                    Bagimana saya import data siswa via excel ?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Akses menu data siswa lalu klik pengaturan setelah itu pilih import data dan download panduan yang sudah tertera pada aplikasi
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                    Bagaimana cara saya menginput soal ?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Pilih ujian nya lalu klik pengaturan soal setelah itu anda bisa klik tambah soal atau bisa juga via import soal excel
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                    Bagaimana cara saya menjawab soal ujian ? 
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Pilih jawaban A/B/C/D/E yang sudah tertera pada aplikasi
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Apa kata mereka</h2>
          <p>Testimoni UKLINE EVENTS</p>
        </header>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Dulu kegiatan belajar mengajar masih menggunakan WA tapi sekarang bisa menggunakan aplikasi UKLINE sehingga untuk pembelajaran merupakan salah satu solusi permasalahan KBM daring di sekolah
                </p>
                <div class="profile mt-auto">
                  <h3>Ibu Neni </h3>
                  <h4>Guru SMPN 5 Karanganyar</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Saya rasa untuk web penunjang pembelajaran ukline sudah cukup baik. fitur-fitur yang bagus serta menyediakan pemisahan antara tugas yg sudah dikerjakan dan yg belum dikerjakan, sehingga saya bisa fokus ke tugas yg belum dikerjakan,memberi tempat mengirim file lebih dari satu untuk mengantisipasi tugas yg memuat banyak jawaban, dan fitur pemisah tugas dan ujian yg berguna.
                </p>
                <div class="profile mt-auto">
                  <h3>Eka Mutiara</h3>
                  <h4>SMPN 1 Karanganyar</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                 Saya senang mengikuti pembelajaran daring yang di laksanakan oleh sekolah saya dapat mengerjakan tugas tugas yang dilaksanakan melalui ukline
                </p>
                <div class="profile mt-auto">
                  <h3>Salsabilah </h3>
                  <h4>Siswi SMPN 5 Karanganyar</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->
            <!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Info lebih lanjut</h2>
          <p>Kontak UKLINE</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-12">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box h-100">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Alamat</h3>
                  <p>Jl. Raya Puncak Seuseupan No. 358 Kelurahan Bendungan, Kecamatan Ciawi, Kota Bogor 16720</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box h-100">
                  <i class="bi bi-telephone"></i>
                  <h3>Hubungi Kami</h3>
                  <p>+62 821-1137-1600 (CS. UKLINE)</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box h-100">
                  <i class="bi bi-instagram"></i>
                  <h3>Media Sosial</h3>
                  <p><a href="https://instagram.com/ukline.id">@ukline.id</a> (Instagram)</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box h-100">
                  <i class="bi bi-clock"></i>
                  <h3>Waktu Layanan</h3>
                  <p>9:00 - 17:00 WIB (Setiap Hari)</p>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>UKLINE.ID</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('landing/assets_landing_akm/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landing/assets_landing_akm/vendor/glightbox/js/glightbox.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('landing/assets_landing_akm/js/main.js')}}"></script>

</body>

</html>
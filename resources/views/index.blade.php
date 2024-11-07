<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $brandName }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/fav.svg') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts Preconnect -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

  <!-- Google Fonts Stylesheet -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename"><span class="app-brand-logo demo" style="margin-bottom: 10px;">
        <svg height="64px" width="64px" style="width:38px!important;margin-bottom: 15px;" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <path class="st0" d="M115.661,133.014l38.064-10.084c1.112-0.214,1.902-1.208,1.902-2.35c0-1.141-0.79-2.136-1.902-2.351 l-38.064-10.083c-0.995-0.225-1.804-1.025-2.018-2.028l-10.046-38.055c-0.264-1.112-1.248-1.902-2.389-1.902 c-1.141,0-2.126,0.79-2.39,1.902l-10.036,38.055c-0.224,1.004-1.034,1.804-2.028,2.028l-38.064,10.083 c-1.113,0.215-1.903,1.21-1.903,2.351c0,1.142,0.79,2.136,1.903,2.35l38.064,10.084c0.995,0.215,1.805,1.024,2.028,2.028 l10.036,38.055c0.264,1.112,1.248,1.902,2.39,1.902c1.14,0,2.125-0.79,2.389-1.902l10.046-38.055 C113.857,134.038,114.666,133.229,115.661,133.014z"></path> <path class="st0" d="M462.695,68.785l-50.283-13.322c-1.317-0.292-2.39-1.346-2.672-2.672L396.476,2.507 C396.125,1.044,394.827,0,393.316,0c-1.512,0-2.809,1.044-3.16,2.507L376.902,52.79c-0.302,1.326-1.365,2.38-2.682,2.672 l-50.284,13.322c-1.473,0.292-2.516,1.599-2.516,3.111s1.044,2.818,2.516,3.101l50.284,13.332c1.317,0.273,2.38,1.346,2.682,2.672 l13.254,50.274c0.35,1.472,1.648,2.516,3.16,2.516c1.511,0,2.808-1.044,3.16-2.516l13.263-50.274 c0.282-1.326,1.355-2.4,2.672-2.672l50.283-13.332c1.473-0.283,2.517-1.589,2.517-3.101S464.168,69.077,462.695,68.785z"></path> <path class="st0" d="M369.529,173.448c-44.842-34.651-80.517-8.153-113.149-8.153c-32.612,0-68.296-26.498-113.139,8.153 C98.399,208.1,98.029,278.152,124.897,360.99c24.459,75.427,41.819,110.634,44.852,126.793 c6.115,32.622,44.843,32.622,52.996-2.038c4.427-18.822,3.072-86.026,33.636-86.026c30.584,0,29.219,67.205,33.647,86.026 c8.153,34.66,46.88,34.66,52.995,2.038c3.033-16.159,20.393-51.366,44.852-126.793C414.743,278.152,414.372,208.1,369.529,173.448z M252.43,258.89l-36.318,9.626c-0.946,0.194-1.726,0.974-1.93,1.93l-9.587,36.309c-0.244,1.062-1.18,1.814-2.272,1.814 c-1.092,0-2.029-0.751-2.273-1.814l-9.586-36.309c-0.214-0.956-0.986-1.736-1.931-1.93l-36.318-9.626 c-1.064-0.204-1.814-1.16-1.814-2.243c0-1.092,0.751-2.038,1.814-2.243l36.318-9.626c0.946-0.205,1.717-0.975,1.931-1.93 l9.586-36.309c0.244-1.062,1.18-1.814,2.273-1.814c1.092,0,2.028,0.751,2.272,1.814l9.587,36.309 c0.205,0.956,0.984,1.726,1.93,1.93l36.318,9.626c1.064,0.205,1.815,1.151,1.815,2.243 C254.245,257.73,253.494,258.686,252.43,258.89z"></path> </g> </g></svg>
      </span>Dental Clinic</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#" >Home<br></a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#doctors">Doctors</a></li>
            <li><a href="#departments">Departments</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="{{ asset('assets/img/main.jpg') }}" alt="" class="img-fluid">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2 class="mb-5">WELCOME TO {{ $brandName }}</h2>
          <p>We are team of talented dentists to take care of your Teeth</p>
        </div><!-- End Welcome -->

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Why Choose Us?</h3>
              <p>
                We offer comprehensive, patient-centered care in a comfortable environment. Our experienced team utilizes advanced technology to ensure exceptional results. With flexible financing options and a commitment to community health, we prioritize your smile and overall well-being.
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->

        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('assets/img/about.jpg') }}" alt="" class="img-fluid">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>About Us</h3>
            <p>
              At Our Dental Clinic, we believe that a healthy smile is the foundation of overall well-being. Our team is dedicated to providing high-quality dental care tailored to meet the unique needs of each patient. With years of experience and a passion for dentistry, we strive to create a comfortable and welcoming environment where you can feel at ease.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Our Mission:</h5>
                  <p>We are committed to enhancing your oral health through comprehensive dental services, including preventive care, cosmetic treatments, and restorative dentistry. Our goal is to empower our patients with knowledge and support, helping them make informed decisions about their dental health.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Patient-Centered Care</h5>
                  <p>We understand that visiting the dentist can be a daunting experience for many. That’s why we prioritize your comfort and well-being at every appointment. From the moment you walk through our doors, our friendly staff will make you feel right at home, providing personalized care that meets your needs.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user-doctor"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
              <p>Doctors</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-regular fa-hospital"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>Departments</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-flask"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
              <p>Research Labs</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-award"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
              <p>Awards</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Following is the list Services We Offer.</p>
      </div><!-- End Section Title -->

      <div class="container">

        @php
        $totalServices = count($services);
        @endphp

        <div class="row gy-4">
          @foreach($services as $index => $service)
          @php
          $colClass = 'col-lg-4 col-md-6'; // Default class
          // If the service is the last in a row, adjust the class
          if ($totalServices % 3 == 1 && $index == $totalServices - 1) {
          // Last item and total items leave a remainder of 1 when divided by 3
          $colClass = 'col-lg-12';
          } elseif ($totalServices % 3 == 2 && ($index == $totalServices - 2 || $index == $totalServices - 1)) {
          // Last two items and total items leave a remainder of 2 when divided by 3
          $colClass = 'col-lg-6 col-md-6';
          }
          @endphp

          <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-heartbeat"></i>
              </div>
              <a href="#" class="stretched-link">
              <h3>{{ $service->name }}</h3>
            </a>
              <p>{{ $service->description }}</p>
              <p class="mt-3"><strong>Fee: {{ $service->price }}</strong></p>
            </div>
          </div>
          @endforeach
        </div>


      </div>

    </section><!-- /Services Section -->

    <!-- Appointment Section -->
    <section id="appointment" class="appointment section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Appointment</h2>
        <p>Pick an Appointment For You in the available Time Slot</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('appointments.store.front') }}" method="post" role="form" class="php-email-form">
          @csrf
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 form-group mt-3">
              <input type="text" name="date" class="form-control datepicker" id="date" placeholder="Pick a Date" required>
            </div>
            <div class="col-md-3 form-group mt-3">
              <select id="time" name="time" class="form-select" required>
                <!-- Options will be populated by JavaScript -->
              </select>
            </div>

            <div class="col-md-3 form-group mt-3">
              <select name="service_id" id="service" class="form-select" required="">
                <option selected disabled>Select Service</option>
                @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 form-group mt-3">
              <select name="user_id" id="doctor" class="form-select" required>
                <option selected disabled>Select Doctor</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
              </select>
            </div>

          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
          </div>
          <div class="mt-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
            <div class="text-center"><button type="submit">Make an Appointment</button></div>
          </div>
        </form>

      </div>

    </section><!-- /Appointment Section -->


    <!-- Doctors Section -->
    <section id="doctors" class="doctors section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Doctors</h2>
      </div>

      <div class="container">

        @php
        $totalDoctors = count($doctors);
        @endphp

        <div class="row gy-4">
          @foreach($doctors as $index => $doctor)
          @php
          $colClass = 'col-lg-6'; // Default class
          if ($totalDoctors % 2 == 1 && $index == $totalDoctors - 1) {
          $colClass = 'col-lg-12';
          }
          @endphp
          <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="member-info">
                <h4>{{$doctor->name}}</h4>
                <span>{{$doctor->phone}}</span>
                <p>{{$doctor->description}}</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>


      </div>

    </section><!-- /Doctors Section -->

    <!-- Departments Section -->
    <section id="departments" class="departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Departments</h2>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">Dental Clinic</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-2">Beauty Parlour</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="departments-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Dental</h3>
                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Parlour</h3>
                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Departments Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">


              <div class="faq-item">
                <h3>Most Asked Question number 1</h3>
                <div class="faq-content">
                  <p>Most Asked Question number 1's answer</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Most Asked Question number 2</h3>
                <div class="faq-content">
                  <p>Most Asked Question number 2's answer</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Most Asked Question number 3</h3>
                <div class="faq-content">
                  <p>Most Asked Question number 3's answer</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
            <h3>Testimonials</h3>
            <p>
              Discover the transformative power of smiles through our dental clinic's before-and-after cases, showcasing our commitment to quality care and patient satisfaction.
            </p>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

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

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Saul Goodman</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>I cannot express how grateful I am for the amazing care I received at [Dental Clinic Name]. The staff was incredibly welcoming and professional, making me feel at ease from the moment I walked in. Dr. [Dentist's Name] took the time to explain every procedure, and I truly appreciated their attention to detail. My smile has never looked better! I highly recommend this clinic to anyone looking for top-notch dental care.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Sara Wilsson</h3>
                        <h4>Designer</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>I cannot express how grateful I am for the amazing care I received at [Dental Clinic Name]. The staff was incredibly welcoming and professional, making me feel at ease from the moment I walked in. Dr. [Dentist's Name] took the time to explain every procedure, and I truly appreciated their attention to detail. My smile has never looked better! I highly recommend this clinic to anyone looking for top-notch dental care.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Jena Karlis</h3>
                        <h4>Store Owner</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>I cannot express how grateful I am for the amazing care I received at [Dental Clinic Name]. The staff was incredibly welcoming and professional, making me feel at ease from the moment I walked in. Dr. [Dentist's Name] took the time to explain every procedure, and I truly appreciated their attention to detail. My smile has never looked better! I highly recommend this clinic to anyone looking for top-notch dental care.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Matt Brandon</h3>
                        <h4>Freelancer</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>I cannot express how grateful I am for the amazing care I received at [Dental Clinic Name]. The staff was incredibly welcoming and professional, making me feel at ease from the moment I walked in. Dr. [Dentist's Name] took the time to explain every procedure, and I truly appreciated their attention to detail. My smile has never looked better! I highly recommend this clinic to anyone looking for top-notch dental care.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>John Larson</h3>
                        <h4>Entrepreneur</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>I cannot express how grateful I am for the amazing care I received at [Dental Clinic Name]. The staff was incredibly welcoming and professional, making me feel at ease from the moment I walked in. Dr. [Dentist's Name] took the time to explain every procedure, and I truly appreciated their attention to detail. My smile has never looked better! I highly recommend this clinic to anyone looking for top-notch dental care.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Discover the transformative power of smiles through our dental clinic's before-and-after cases, showcasing our commitment to quality care and patient satisfaction.</p>
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-1.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-1.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-2.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-2.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-3.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-3.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-4.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-4.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-5.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-5.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-6.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-6.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-7.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-8.jpg" class="glightbox" data-gallery="images-gallery">
              <img src="{{ asset('assets/img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
            </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d24175.34840238774!2d71.7390264!3d34.1515327!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d939cc8305d22d%3A0x4453f01f10452a27!2sMansha%20Dental%20and%20Cosmetics!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Location</h3>
                <p>{!! $address !!}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="{{ route('contact.send') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4 justify-content-around">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="#" class="logo d-flex align-items-center">
          <span class="sitename">Dental Clinic</span>
        </a>
          <div class="footer-contact pt-3">
            <p>{!! $address !!}</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            @foreach($services->take(7) as $service)
            <li><a href="#services">{{ $service->name }}</a></li>
            @endforeach
            <li><a href="#services">And More ...</a></li>
          </ul>
        </div>

        <!-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div> -->

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Dental Clinic</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  </script>
  <script src="https://chatcraft.fineit.io/embed.js/03d2a370-5e50-47ce-b0d0-c6729da317ce/"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const timeSelect = document.getElementById('time');
    // Function to format time to 12-hour clock with AM/PM
    function formatTimeTo12Hour(hours) {
      const period = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert to 12-hour format
      return `${hours} ${period}`;
    }

    // Function to generate time options
    function generateTimeOptions() {
      for (let hours = parseInt({{$start_time}}); hours <= parseInt({{$end_time}}); hours++) {
        const value = `${('0' + hours).slice(-2)}:00`;
        const text = formatTimeTo12Hour(hours);
        const option = new Option(text, value);
        timeSelect.add(option);
      }
    }

    generateTimeOptions();
  });
    document.addEventListener('DOMContentLoaded', () => {
      flatpickr('#date', {
        dateFormat: 'F j, Y',
        altInput: true,
        altFormat: 'F j, Y',
        minDate: 'today'
      });
    });
  </script>


  <style type="text/css">
  @media (max-width: 992px) {
      .departments .nav-link.active {
          color: #fff !important;
          background: var(--accent-color);
      }
  }

  </style>
</body>

</html>

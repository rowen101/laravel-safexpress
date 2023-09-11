@extends('layouts.safexpress')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/about-header.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center">

        <h2>{{$title}}</h2>
        <ol>
          <li><a href="/">Home</a></li>
          <li>{{$title}}</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container aos-init aos-animate" data-aos="fade-up">

          <div class="row gy-4 aos-init aos-animate" data-aos="fade-up">
            <div class="col-lg-4" data-aos="fade-right">
              <img src="{{asset('/img/about.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8">
              <div class="content ps-lg-5" data-aos="fade-left">
                <h3>About Safexpress</h3>
                <p>
                    We at Safexpress Logistics Inc. uphold our a good reputation as one of the best logistics company in the
                    Philippines.
                    We’re dedicated to providing our clients the very best of Supply Chain Solutions, with an emphasis on
                    our companies mission, vision & core values.
                  </p>
                <ul>
                  <li><i class="bi bi bi-truck"></i> Safexpress Logistics Inc. contenues its mission in providing outstanding delivery and warehousing solutions to our existing clients.</li>
                  <li><i class="bi bi bi-award-fill"></i> We aspire to be the creative and innovative leader in the industry, anticipating the market needs and steering our company towards long-term successa and growth.</li>

                </ul>
              </div>
            </div>
          </div>

        </div>
      </section>

      @include("pages.partial_page.company")

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
          <div class="section-header">
            <h2>Overview</h2>

          </div>
          <div class="row gy-4" >

            <div class="col-lg-12" data-aos="fade-down">
              <div class="content ps-lg-5">

                <p>
                    We at Safexpress Logistics Inc. uphold our good reputation as one of the best logistics company in the Philippines. We're dedicated to providing our clients the very best of Supply Chain Solutions, with an emphasis on our companies mission, vision & core values.
                </p>
                <p>
                    We aspire to be the creative and innovative leader in the industry, anticipating the market needs and steering our company towards  long-term success and growth.
                </p>
              </div>
            </div>
          </div>

        </div>
      </section>

    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Quality Policy</h2>

        </div>
        <div class="row gy-4" >
          <div class="col-lg-5">
            <div class="content ps-lg-5" data-aos="fade-right">
              <h4>Safexpress is committed to run its
                operations with utmost adherence to:</h4>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i>Food Safety</li>
                <li><i class="bi bi-check-circle-fill"></i> Service Quality</li>
                <li><i class="bi bi-check-circle-fill"></i> Environment Health</li>
                <li><i class="bi bi-check-circle-fill"></i> Safety Standards</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-7" data-aos="fade-left">
            <div class="content ps-lg-5">

              <p>
                We will accomplish this by understanding the needs of our customers and
                complying all applicable requirements, standards, and statutory regulations.
              </p>
              <p>
                The management is always on top of its Team to lead and provide resources to
                secure awareness for everyone and maintain its implementation in our operations.
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Board Of Directors</h2>

        </div>

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-1.jpg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>EDEN S. SATINITIGAN</h4>
                <span>President/CEO</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-2.jpg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>DARLYN ALEJANDRO</h4>
                <span>COO/CFO</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-4.jpg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>JOHN ANGELO CRUZ</h4>
                <span>Director</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-3.jpg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>JULIUS VINCENT LIBANG</h4>
                <span>Corporate Secretary/Legal</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>
    </section><!-- End Team Section -->
@endsection

@extends('layouts.safexpress')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center);" style="background-image: url('img/about-header.jpg');">
    <div class="container position-relative d-flex flex-column align-items-center">

      <h2>{{$title}}</h2>
      <ol>
        <li><a href="/">Home</a></li>
        <li>{{$title}}</li>
      </ol>

    </div>
  </div><!-- End Breadcrumbs -->

   <!-- ======= brach Section ======= -->
   <section id="contact" class="contact">
    <div class="container position-relative" data-aos="fade-up">

      <div class="row gy-4 d-flex justify-content-end">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="250">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6 ">
                    <div class="custom-select">
                        <select name="role_id" id="role_id">
                          <option value="option_select" disabled>Role</option>
                          <option value="1" >JSU</option>
                        </select>

                      </div>
                </div>

              </div>



            </form>

          </div><!-- End Contact Form -->
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
            <div class="info-item d-flex">
                <i class="bi bi-person flex-shrink-0"></i>
                <div>
                  <h4>Site Head:</h4>
                  <p>Josh</p>
                </div>
              </div><!-- End Info Item -->
          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h4>Location:</h4>
              <p></p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h4>Email:</h4>
              <p></p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex">
            <i class="bi bi-phone flex-shrink-0"></i>
            <div>
              <h4>Call:</h4>
              <p></p>
            </div>
          </div><!-- End Info Item -->

        </div>



      </div>

    </div>
  </section><!-- End Contact Section -->


  </section><!-- End Contact Section -->
@endsection

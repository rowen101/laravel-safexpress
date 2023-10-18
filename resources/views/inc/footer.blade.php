 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

<div class="footer-content">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-info">
        <a href="index.html" class="logo d-flex align-items-center">
          <span>Safexpress</span>
        </a>
        <p>{{$setting->site_address}}</p>
        <div class="social-links d-flex  mt-3">
          {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> --}}
          <a href="https://www.facebook.com/SafexpressLogisticsInc/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.linkedin.com/company/safexpress-logistics-inc/" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
          <a href="https://www.youtube.com/@safexpressphilippines" target="_blank" class="youtube"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
            <li><i class="bi bi-dash"></i> <a href="{{url('/')}}">Home</a></li>
            <li><i class="bi bi-dash"></i> <a href="{{url('/about')}}">About us</a></li>
            <li><i class="bi bi-dash"></i> <a href="{{url('/services')}}">Services</a></li>

        </ul>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bi bi-dash"></i> <a href="{{url('/warehouse-management')}}">Warehouse Management</a></li>
          <li><i class="bi bi-dash"></i> <a href="{{url('/transport-services')}}">Tranport Services</a></li>
          <li><i class="bi bi-dash"></i> <a href="{{url('/other-services')}}">Other Service</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
        <h4>Contact Us</h4>
        <p>

          <strong>Phone:</strong>&nbsp;{{ $setting->site_phone }}<br>
          <strong>Email:</strong>&nbsp;{{ $setting->site_email }}<br>
        </p>

      </div>

    </div>
  </div>
</div>

<div class="footer-legal">
  <div class="container">
    <div class="copyright">
        Copyright &copy; {{ now()->year }}  <strong><span>Safexpress</span></strong>. All Rights Reserved
    </div>

  </div>
</div>
</footer><!-- End Footer --><!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
  class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('vendor/aos/aos.js')}}"></script>
<script src="{{ asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{ asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{ asset('vendor/php-email-form/validate.js')}}"></script>


<script src="{{ asset("js/lightbox-plus-jquery.min.js") }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('js/main.js')}}"></script>
@vite('resources/js/app.js')


<script>
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /*for each element, create a new DIV that will act as the selected item:*/
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /*for each element, create a new DIV that will contain the option list:*/
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
              if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                yl = y.length;
                for (k = 0; k < yl; k++) {
                  y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                break;
              }
            }
            h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
          /*when the select box is clicked, close any other select boxes,
          and open/close the current select box:*/
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide");
          this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
      /*a function that will close all select boxes in the document,
      except the current select box:*/
      var x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);


    </script>


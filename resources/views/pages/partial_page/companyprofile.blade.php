<!-- ======= About Section ======= -->
<section  class="about">
    <div class="container" data-aos="fade-up">


            <div id="slider">
                <div class="slides">
                    @foreach ($companyprofile as $item)
                    <div class="slide">
                        <img class="img" draggable="false" src="{{asset($item->company_img)}}" alt={{$item->id}}>
                    </div>

                    @endforeach
                </div>

                <div class="navigation">
                    <div class="prev" onclick="changeSlide(-1)">❮</div>
                    <div class="next" onclick="changeSlide(1)">❯</div>
                </div>

                <div class="info">Slide <span id="currentSlide">1</span> of <span id="totalSlides">3</span></div>
            </div>


    </div>

    </div>

    @push('buttom')
    <script>
        let slideIndex = 1;
        let touchStartX = 0;
        let touchMoveX = 0;
        let isDragging = false;
        let inactivityTimeout;

        function changeSlide(n) {
            showSlides(slideIndex += n);
            resetInactivityTimeout();
        }

        function showSlides(n) {
            let i;
            const slides = document.querySelectorAll('.slide');
            const totalSlides = document.getElementById('totalSlides');
            const currentSlide = document.getElementById('currentSlide');

            if (n > slides.length) {
                slideIndex = 1;
            }

            if (n < 1) {
                slideIndex = slides.length;
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }

            slides[slideIndex - 1].style.display = 'block';

            // Update slide information
            currentSlide.textContent = slideIndex;
            totalSlides.textContent = slides.length;

            // Hide navigation buttons if no more slides
            const navigation = document.querySelector('.navigation');
            if (slides.length === 1) {
                navigation.style.opacity = 0;
            } else {
                navigation.style.opacity = 1;
            }
        }

        function resetInactivityTimeout() {
            clearTimeout(inactivityTimeout);
            const navigation = document.querySelector('.navigation');
            navigation.style.opacity = 1;

            inactivityTimeout = setTimeout(() => {
                navigation.style.opacity = 0;
            }, 3000); // Adjust the time in milliseconds for inactivity timeout
        }

        // Initial display
        showSlides(slideIndex);

        // Touch event handling for image holding and sliding
        const slider = document.getElementById('slider');

        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            isDragging = true;
            resetInactivityTimeout();
        });

        slider.addEventListener('touchmove', (e) => {
            if (isDragging) {
                touchMoveX = e.changedTouches[0].screenX;
                const swipeDistance = touchMoveX - touchStartX;
                slider.querySelector('.slides').style.transform = `translateX(${swipeDistance}px)`;
            }
        });

        slider.addEventListener('touchend', () => {
            if (isDragging) {
                const swipeDistance = touchMoveX - touchStartX;
                isDragging = false;

                if (swipeDistance > 50) {
                    changeSlide(-1); // Swipe right
                } else if (swipeDistance < -50) {
                    changeSlide(1); // Swipe left
                } else {
                    // Reset if the swipe distance is not significant
                    slider.querySelector('.slides').style.transform = 'translateX(0)';
                }
            }
        });

        // Mouse event handling for inactivity timeout and button visibility
        document.addEventListener('mousemove', (e) => {
            resetInactivityTimeout();
            const navigation = document.querySelector('.navigation');
            navigation.style.opacity = 1;
        });

        // Hide buttons when mouse leaves the slider area
        slider.addEventListener('mouseleave', () => {
            const navigation = document.querySelector('.navigation');
            navigation.style.opacity = 0;
        });
    </script>
    @endpush
  </section>


    // HEADER SLIDER

    
    const heroSlider = document.querySelector("[data-hero-slider]");
    const heroSliderItems = document.querySelectorAll("[data-hero-slider-item]");
    const heroSliderPrevBtn = document.querySelector("[data-prev-btn]");
    const heroSliderNextBtn = document.querySelector("[data-next-btn]");
    
    
    
    let currentSlidePos = 0;
    let lastActiveSliderItem = heroSliderItems[0];
    
    const updateSliderPos = function () {
        lastActiveSliderItem.classList.remove("active");
        heroSliderItems[currentSlidePos].classList.add("active");
        lastActiveSliderItem = heroSliderItems[currentSlidePos];
    }
    
    const slideNext = function () {
      if (currentSlidePos >= heroSliderItems.length - 1) {
        currentSlidePos = 0;
      } else {
        currentSlidePos++;
      }
    
      updateSliderPos();
    }
    
    
    
    heroSliderNextBtn.addEventListener("click", slideNext);
    
    const slidePrev = function () {
      if (currentSlidePos <= 0) {
        currentSlidePos = heroSliderItems.length - 1;
      } else {
        currentSlidePos--;
      }
    
      updateSliderPos();
    }
    
    
    heroSliderPrevBtn.addEventListener("click", slidePrev);
    
    /**
     * auto slide
     */
    
    let autoSlideInterval;
    
    const autoSlide = function () {
      autoSlideInterval = setInterval(function () {
        slideNext();
      }, 7000);
    }
    
    autoSlide();


// UPLOAD DE LA PHOTO DE L'ETUDIANT
const photoInput = document.getElementById('photoInput');
  const previewContainer = document.getElementById('previewContainer');

  photoInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (event) => {
      previewContainer.innerHTML = `<img src="${event.target.result}" alt="Preview" class="object-cover w-full h-full" />`;
    };
    reader.readAsDataURL(file);
});
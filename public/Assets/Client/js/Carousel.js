const carousel = document.querySelectorAll('.carousel-wrapper__slide')
dot = document.querySelectorAll('.dot')
let slideIndex = 0

let timer = setInterval(autoSlide, 3500)
function autoSlide() {
    slideIndex++
    slideShow(slideIndex)
    resetTimer()
}

function currentSlide(index) {
    slideIndex = index
    slideShow(slideIndex)
    resetTimer()
}

function resetTimer() {
    clearInterval(timer)
    timer = setInterval(autoSlide, 3500)
}

function slideShow(index) {
    let i
    for (i = 0; i < carousel.length; i++) {
        carousel[i].style.display = 'none'
    }
    for (i = 0; i < dot.length; i++) {
        dot[i].classList.remove('active')
    }
    if (index > carousel.length) {
        slideIndex = 1
    }
    if (index < 1) {
        slideIndex = carousel.length
    }

    carousel[slideIndex - 1].style.display = 'block'
    dot[slideIndex - 1].classList.add('active')
}
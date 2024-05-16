
var indexSlider = 0;
var sliderInterval;

const slider = function () {
    const sliders = $$('.slider .left img');

    if (indexSlider >= sliders.length) {
        indexSlider = 0;
    }

    deleteActive();
    setActive(indexSlider);
}

const autoload = function () {
    indexSlider++;
    slider();
}

const deleteActive = function () {
    const activeSlider = $('.slider .left .active');
    const activePagination = $('.slider .left .pgn-active');

    if (activeSlider) {
        activeSlider.classList.remove('active');
    }

    if (activePagination) {
        activePagination.classList.remove('pgn-active');
    }
}

const setActive = function (index) {
    const sliders = $$('.slider .left img');
    const paginations = $$('.slider .left .pgn-list p');

    if (sliders[index]) {
        sliders[index].classList.add('active');
    }

    if (paginations[index]) {
        paginations[index].classList.add('pgn-active');
    }
}

const restartSliderInterval = function () {
    clearInterval(sliderInterval);
    sliderInterval = setInterval(autoload, 4000);
}

$('.slider .pgn-list').addEventListener('click', (event) => {
    const paginations = $$('.slider .left .pgn-list p');
    indexSlider = Array.from(paginations).indexOf(event.target);
    if(indexSlider !== -1) {
        slider();
        restartSliderInterval();
    }
});

$('.slider-control .next').addEventListener('click', () => {
    console.log('next', indexSlider)
    indexSlider++;
    slider();
    restartSliderInterval();
});

$('.slider-control .prev').addEventListener('click', () => {
    console.log('prev', indexSlider)
    indexSlider--;
    slider();
    restartSliderInterval();
});

sliderInterval = setInterval(autoload, 4000);
import './bootstrap';
import './bookPage/preview';
import './bookPage/scroll';

function changePreview(element) {
    if (!element.classList.contains('opened-preview')) {
        let previews = document.querySelectorAll('.book-img-mini');
        let main = document.querySelector('.book-cover');
        let toRemove = main.src;
        previews.forEach(prev => {
            if (prev.src == toRemove) {
                prev.classList.toggle('opened-preview');
            }
            main.src = element.src;
            element.classList.add('opened-preview');

        });
    }
}

// scroll through similar books
function sideScroll(id, direction) {
    scrollAmount = 0;
    let element = document.querySelector("." + id);
    let speed = 15;
    let distance = 300;
    let step = 10;
    let slideTimer = setInterval(function() {
        if (direction == 'left') {
            element.scrollLeft -= step;
        } else {
            element.scrollLeft += step;
        }
        scrollAmount += step;
        if (scrollAmount >= distance) {
            window.clearInterval(slideTimer);
        }
    }, speed);
}


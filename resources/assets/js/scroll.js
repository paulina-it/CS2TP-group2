// scroll through similar books
document.getElementById('scrollLeftBtn').addEventListener('click', function() {
    sideScroll('similar-books-list', 'left');
});

document.getElementById('scrollRightBtn').addEventListener('click', function() {
    sideScroll('similar-books-list', 'right');
});

function sideScroll(id, direction) {
    let scrollAmount = 0;
    let element = document.querySelector("." + id);
    let speed = 15;
    let distance = 300;
    let step = 10;
    let slideTimer = setInterval(function () {
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

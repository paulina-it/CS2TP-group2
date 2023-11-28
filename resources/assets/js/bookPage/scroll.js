// function slideRight(id) {
//     let container = document.getElementById(id);
//     sideScroll(container, 'right');
// }

function sideScroll(id, direction) {
    scrollAmount = 0;
    let element = document.getElementById(id);
    let speed = 25;
    let distance = 100;
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
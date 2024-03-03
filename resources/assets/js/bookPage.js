//change book preview on click
const prevImages = document.querySelectorAll('.book-img-mini');
prevImages.forEach(image => {
    image.addEventListener('click', () => changePreview(image))
});

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
// console.log('hello');


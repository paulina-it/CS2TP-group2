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

//change modal previews
const modalPrevImages = document.querySelectorAll('.book-img-mini-modal');
modalPrevImages.forEach(image => {
    image.addEventListener('click', () => changePreviewModal(image))
});

function changePreviewModal(element) {
    if (!element.classList.contains('opened-preview')) {
        let previews = document.querySelectorAll('.book-img-mini-modal');
        let main = document.querySelector('.book-cover-modal');
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

document.addEventListener("DOMContentLoaded", function () {
    var image = document.querySelector('.book-cover');
    var modal = document.getElementById("zoomModal");
    var closeButton = document.querySelector(".close");

    image.addEventListener('click', function () {
        openModal(image.src);
    });

    closeButton.onclick = function() {
        closeModal();
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    };
    function openModal(imageSrc) {
        modal.style.display = "flex";
        document.querySelector('.book-cover-modal').src = imageSrc;
    }
    function closeModal() {
        modal.style.display = "none";
    }
});

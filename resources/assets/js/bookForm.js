document.getElementById('main-img-upload').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const imagePreview = document.getElementById('main-img-preview');
        imagePreview.style.display = 'block';
        imagePreview.src = e.target.result;
    };

    reader.readAsDataURL(file);
});

document.getElementById('other-img-upload').addEventListener('change', function (event) {
    const files = event.target.files;
    const imagePreviewDiv = document.getElementById('other-images-preview');

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreviewDiv.innerHTML += `<img class="book-form-preview" src="${e.target.result}" alt="..."/>`;
        };

        reader.readAsDataURL(file);
    }
});
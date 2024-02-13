let toggleButton = document.getElementById('toggleButton');

addEventListener("load", (event) => {
    toggleButton = document.getElementById('toggleButton');
});

toggleButton.addEventListener('click', function () {
    let iconOpen = document.getElementById('iconOpen');
    let iconClose = document.getElementById('iconClose');
    let menu = document.getElementById('menu');

    menu.classList.toggle('hidden');
    iconOpen.classList.toggle('hidden');
    iconClose.classList.toggle('hidden');
    iconOpen.classList.toggle('inline-flex');
});

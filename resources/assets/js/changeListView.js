let saveViewChoiceRoute = "{{ route('save.view.choice') }}";

let rows = document.querySelector('#rows-view');
let grid = document.querySelector('#grid-view');
let filtersBtn = document.querySelector('.filters-header');

rows.addEventListener('click', () => {
    document.querySelector('#rows-form').submit();
});

grid.addEventListener('click', () => {
    document.querySelector('#grid-form').submit();
});

filtersBtn.addEventListener('click', () => {
    let filtersDiv = document.querySelector('.search-sidebar');
    if (filtersDiv.style.display == 'none') {
        filtersDiv.style.display = 'flex';
    } else {
        filtersDiv.style.display = 'none';
    }
})
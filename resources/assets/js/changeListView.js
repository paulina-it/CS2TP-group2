let saveViewChoiceRoute = "{{ route('save.view.choice') }}";

let rows = document.querySelector('#rows-view'); 
let grid = document.querySelector('#grid-view');

rows.addEventListener('click', (event) => {
    // document.querySelector('.books-rows').style.display = 'block';
    // document.querySelector('.books-list').style.display = 'none';
    document.querySelector('#rows-form').submit();
});

grid.addEventListener('click', (event) => {
    // document.querySelector('.books-rows').style.display = 'none';
    // document.querySelector('.books-list').style.display = 'flex';
    document.querySelector('#grid-form').submit();
});
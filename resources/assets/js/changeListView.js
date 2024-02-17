let rows = document.querySelector('#rows-view'); 
let grid = document.querySelector('#grid-view');
//.books-rows and .books-list
rows.addEventListener('click', (event) => {
    document.querySelector('.books-rows').style.display = 'block';
    document.querySelector('.books-list').style.display = 'none';
})

grid.addEventListener('click', (event) => {
    document.querySelector('.books-rows').style.display = 'none';
    document.querySelector('.books-list').style.display = 'flex';
})
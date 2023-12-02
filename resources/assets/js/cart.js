let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');


openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})

closeShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})

closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    {
        id: 1,
        name: 'BOOK NAME 1',
        image: '1.PNG',
        price: '£12.90'
    },

    {
        id: 2,
        name: 'BOOK NAME 2',
        image: '2.PNG',
        price: '£12.90'
    },

    {
        id: 3,
        name: 'BOOK NAME 3',
        image: '3.PNG',
        price: '£12.90'
    },
];

let listCards = [];

function initApp() {
    products.forEach((value, key)=>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src ="image/${value.image}"/>
            <div class= "title">${value.name}</div>
            <div class= "price">${value.price.toLocalString()}</div>
             <button onClick= "addToCard(${key})">Add to card</button>
        `;
        list.appendChild(newDiv);
    })
}

initApp();
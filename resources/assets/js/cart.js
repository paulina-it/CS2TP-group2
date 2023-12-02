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
            <div class= "price">${value.price.toLocaleString()}</div>
            <button onClick= "addToCard(${key})">Add to card</button>
        `;

        list.appendChild(newDiv);
    })
}

initApp();
function addToCard(key) {
    if(listCards[key] == null) {
        listCards[key] = products[key];
        listCards[key].quantity = 1;
    }

    reloadCard();
}

function reloadCard() {
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;

        if(value != null) {
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src = "image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString}</div>
                <div>${value.quantity}</div>
                <div>
                    <button onClick = "changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onClick = "changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>
            `;
            listCard.appendChild(newDiv);
        }
    })
    
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
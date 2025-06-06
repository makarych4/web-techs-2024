const PIZZA_CONFIG= {
    'Маргарита': { price: 500, calories: 300 },
    'Пепперони': { price: 800, calories: 400 },
    'Баварская': { price: 700, calories: 450 }
};

const SIZE_CONFIG = {
    'Маленькая': { price: 100, calories: 100 },
    'Большая': { price: 200, calories: 200 }
};

const TOPPING_CONFIG = {
    'сливочная моцарелла': {
        'Маленькая': { price: 50, calories: 20 },
        'Большая': { price: 100, calories: 20 }
    },
    'сырный борт': {
        'Маленькая': { price: 150, calories: 50 },
        'Большая': { price: 300, calories: 50 }
    },
    'чедер и пармезан': {
        'Маленькая': { price: 150, calories: 50 },
        'Большая': { price: 300, calories: 50 }
    }
};

class Pizza {
    constructor(name, size) {
        const pizzaData = PIZZA_CONFIG[name];
        const sizeData = SIZE_CONFIG[size];

        this.name = name;
        this.size = size;
        this.toppings = new Set();

        this.price = pizzaData.price + sizeData.price;
        this.calories = pizzaData.calories + sizeData.calories;
    }

    addTopping(toppingName) {
        const toppingData = TOPPING_CONFIG[toppingName]?.[this.size];

        this.toppings.add(toppingName);
        this.price += toppingData.price;
        this.calories += toppingData.calories;
    }

    removeTopping(toppingName) {
        const toppingData = TOPPING_CONFIG[toppingName][this.size];

        this.toppings.delete(toppingName);
        this.price -= toppingData.price;
        this.calories -= toppingData.calories;
    }

    getToppings() {   return Array.from(this.toppings); }
    getStuffing() {         return this.name; }
    getSize() {             return this.size; }
    calculatePrice() {      return this.price; }
    calculateCalories() {   return this.calories; }
}

let currentPizza = new Pizza("Пепперони", "Маленькая");

function updateCalculator() {
    document.getElementById("Pizza").textContent = "Выбрано: " + currentPizza.getStuffing();
    document.getElementById("Size").textContent = "Выбрано: " + currentPizza.getSize();
    document.getElementById("basket_button").textContent = `Добавить в корзину за ${currentPizza.calculatePrice()}₽ (${currentPizza.calculateCalories()} кКал)`;
}

function selectPizza(pizzaName) {
    const newPizza = new Pizza(pizzaName, currentPizza.getSize());
    for (const topping of currentPizza.getToppings()) {
        newPizza.addTopping(topping);
    }
    currentPizza = newPizza;
    updateCalculator();
}

function selectSize(sizeName) {
    const newPizza = new Pizza(currentPizza.getStuffing(), sizeName);
    for (const topping of currentPizza.getToppings()) {
        newPizza.addTopping(topping);
    }
    currentPizza = newPizza;
    updateCalculator();
}

function toggleTopping(toppingName, buttonElement) {
    if (currentPizza.getToppings().includes(toppingName)) {
        currentPizza.removeTopping(toppingName);
        buttonElement.classList.remove('special');
    } else {
        currentPizza.addTopping(toppingName);
        buttonElement.classList.add('special');
    }
    updateCalculator();
}

updateCalculator();
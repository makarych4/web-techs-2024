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

let pizza = new Pizza("Пепперони", "Маленькая");
console.log(pizza.getSize() + " " + pizza.getStuffing());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
console.log('---');

pizza = new Pizza("Маргарита", "Маленькая");
console.log(pizza.getSize() + " " + pizza.getStuffing());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
pizza.addTopping("сырный борт");
pizza.addTopping("сливочная моцарелла");
pizza.addTopping("чедер и пармезан");
console.log(pizza.getToppings());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
pizza.removeTopping("чедер и пармезан");
pizza.removeTopping("сырный борт");
console.log(pizza.getToppings());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
console.log('---');

pizza = new Pizza("Баварская", "Большая");
console.log(pizza.getSize() + " " + pizza.getStuffing());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
pizza.addTopping("сырный борт");
pizza.addTopping("чедер и пармезан");
pizza.addTopping("сливочная моцарелла");
console.log(pizza.getToppings());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
pizza.removeTopping("сливочная моцарелла");
pizza.removeTopping("сырный борт");
console.log(pizza.getToppings());
console.log(pizza.calculatePrice() + " " + pizza.calculateCalories());
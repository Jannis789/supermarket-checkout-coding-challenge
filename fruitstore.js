const products = {
    fr1: {
        name: "Fruit tea",
        price: 3.11,
        stock: Infinity,
        priceRule: (amount) => {
            const price = products.fr1.price;
            if (amount > 1) {
                return (amount - 1) * price;
            }
            return amount * price;
        }
    },
    sr1: {
        name: "Strawberry",
        price: 5,
        stock: Infinity,
        priceRule: (amount) => {
            const price = products.sr1.price;
            if (amount >= 3) {
                return amount * 4.5;
            }
            return amount * price;
        }
    },
    cf1: {
        name: "Coffee",
        price: 11.23,
        stock: Infinity,
        priceRule: (amount) => {
            return amount * products.cf1.price;
        }
    }
}

class shoppingCart {
    constructor() {
        this.products = products;
        this.cart = {
            total: 0,
            itemList: []
            /*itemList: [{
                product: null,
                amount: 0
            }]*/
        };
    }

    get evalPrice() {
        const itemList = this.cart.itemList;
        let sum = 0;
        itemList.forEach(item => {
            sum += item.product.priceRule(item.amount);
        });
        return sum.toFixed(2); // make sure to output only with 2 decimal places
    }

    addProduct(product, amount) { // adds a product to the cart
        const itemList = this.cart.itemList;
        this.cart.total += amount; // increase the total by the amount of the product
        
        const foundItem = itemList.find(item => {
            if (item.product === product) {
                item.amount += amount; // decrease the amount of the product, if it is already in the cart
                return true; // if product is found, return true
            }
        });
        
        if (!foundItem) { // if the same kind of product isn't in the cart, add it as new entry
            itemList.push({
                product: product,
                amount: amount
            });
        }
    }

    removeProduct(product, amount) {
        const itemList = [...this.cart.itemList];

        this.cart.itemList = itemList.filter(item => {
            if (item.product === product) {
                const oldAmount = item.amount;
                item.amount -= amount;
                // If the amount is under 0, decrease the total by the old amount
                if (item.amount < 0) {
                    this.cart.total -= oldAmount;
                } else { // else, decrease the total by the amount
                    this.cart.total -= amount;
                }
                // filter items which amount is over 0
                return item.amount > 0;
            }
            return item; // sets the filtered items as a child of itemList
        });
    }
    
    get removeAllProducts() {
        this.cart = {
            total: 0,
            itemList: []
        };
    }
    
    get viewCart() {
        return this.cart;
    }

    get displayCartContent() {
        const itemList = this.cart.itemList;
        const listOfProducts = [];
        itemList.forEach(item => {
            for (let i = 0; i < item.amount; i++) {
                if (item.product.name) {
                    listOfProducts.push(item.product.name);
                }
            }
        });
        return listOfProducts;
    }
}

const myCart = new shoppingCart();

console.log(" ------ Testcase 1 ------ ");

myCart.addProduct(products.fr1, 1);
myCart.addProduct(products.sr1, 1);
myCart.addProduct(products.fr1, 1);
myCart.addProduct(products.fr1, 1);
myCart.addProduct(products.cf1, 1);

console.log("Cart Content: " + myCart.displayCartContent.join(', '));
console.log("Expected Total: " + myCart.evalPrice); 

myCart.removeAllProducts;

console.log(" ------ Testcase 2 ------ ");

myCart.addProduct(products.fr1, 1);
myCart.addProduct(products.fr1, 1);

console.log("Cart Content: " + myCart.displayCartContent.join(', '));
console.log("Expected Total: " + myCart.evalPrice); 

myCart.removeAllProducts;

console.log(" ------ Testcase 3 ------ ");

myCart.addProduct(products.sr1, 1);
myCart.addProduct(products.sr1, 1);
myCart.addProduct(products.fr1, 1);
myCart.addProduct(products.sr1, 1);

console.log("Cart Content: " + myCart.displayCartContent.join(', '));
console.log("Expected Total: " + myCart.evalPrice); 

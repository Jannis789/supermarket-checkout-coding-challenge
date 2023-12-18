# supermarket checkout - coding challenge

Checkout engine for the supermarket

My approach on the challenge is findable at ```fruitstore.js```

## Challenge Conditions

* Use PHP, Java, C#, Golang, Typescript, or JavaScript to implement the engine
* You can use a simple class, a framework, or structured files as you see fit.
* Return the result as a link to a private repository or a zip archive via e-mail
* We will review your results together

## Requirements

Implement a checkout system that fulfills these requirements:

1. Our supermarket's CEO has prompted us to open a new supermarket that sells these three products:

    | Product code | Name         | Price   |
    |--------------|--------------|---------|
    | FR1          | Fruit tea    | 3.11 €  |
    | SR1          | Strawberry   | 5.00 €  |
    | CF1          | Coffee       | 11.23 € |

2. The CEO is a big fan of **buy-one-get-one-free offers** and fruit tea. He wants us to add a rule to do this.
3. The COO likes low prices and wants people buying strawberries to get a discount for bulk purchases. If you buy 3 or more strawberries, the price should drop to 4.50 €
4. Our checkout sells items in any order, and because the CEO and COO change their minds often, it needs to be flexible regarding our pricing rules.
5. The interface of our checkout class looks like this (shown in PHP):

    ```php  
    $checkout = new Checkout($pricingRules); 
    $checkout->addToCart($item);
    $checkout->addToCart($item); 
    $price = $checkout->getTotal();
    ```

## Test cases

### Testcase 1
``` 
Cart content: FR1, SR1, FR1, FR1, CF1 
Expected Total: 22.45 €
```

### Testcase 2
``` 
Cart content: FR1, FR1
Expected Total: 3.11 €
``` 

### Testcase 3
``` 
Cart content: SR1, SR1, FR1, SR1
Expected Total: 16.61 €
``` 

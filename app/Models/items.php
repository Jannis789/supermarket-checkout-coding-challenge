<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class items extends Model {

    protected static $products;

    public static function initializeProducts() {
        self::$products = [
            'fr1' => [
                'id' => 'fr1',
                'name' => 'Fruit Tea',
                'price' => 3.11,
                'priceCalc' => function ($amount) {
                    if ($amount > 1) {
                        return ($amount-1) * 3.11;
                    }
                    return $amount * 3.11;
                }
            ],
            'sr1' => [
                'id' => 'sr1',
                'name' => 'Strawberry',
                'price' => 5.00,
                'priceCalc' => function ($amount) {
                    if ($amount >= 3) {
                        return $amount * 4.50;
                    }
                    return $amount * 5.00;
                }
            ],
            'cf1' => [
                'id' => 'cf1',
                'name' => 'Coffee',
                'price' => 11.23,
                'priceCalc' => function ($amount) {
                    return $amount * 11.23;
                }
            ]
        ];
        self::createProduct('bn1', 'Banana', 2.76);
        self::createProduct('bn3', 'Banana2', 22.76);
    }

    
    public static function createProduct($id, $name, $price) {

        $products = self::getProducts();

        $func = function ($amount) use ($price) {
            return $amount * $price;
        };
    
        $products[$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'priceCalc' => $func
        ];
        
        self::$products = $products;
        // Session::put('products', $products); // FEHLER: Serialization of 'Closure' is not allowed
    }
    
    
    
    
    public static function getProducts() {
        if (Session::has('products')) self::$products = Session::get('products', self::$products);
        if (!isset(self::$products)) {
            self::initializeProducts();
        }
        return self::$products;
    }
}



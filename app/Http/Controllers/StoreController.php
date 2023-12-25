<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class StoreController extends Controller {
    public function __construct() {
        $this->products = [
            'fr1' => [
                'id' => 'fr1',
                'name' => 'Fruit Tea',
                'price' => 3.11
            ],
            'sr1' => [
                'id' => 'sr1',
                'name' => 'Strawberry',
                'price' => 5.00
            ],
            'cf1' => [
                'id' => 'cf1',
                'name' => 'Coffee',
                'price' => 11.23
            ]
        ];
        $this->cart = [
            'total' => 0,
            'items' => []
        ];
    }
    
    public function index() {
        $this->cart = Session::get('cart', $this->cart);
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);
    }

    public function addToCart(Request $request) {  
        $this->cart = Session::get('cart', $this->cart);      
        $items = $this->cart['items'];
        $productsToAdd = $request->except('_token');
        $amount = 0;
        foreach (array_keys($productsToAdd) as $productID) {
            $amount = $productsToAdd[$productID];
            $items[$productID] = $amount;
        }
        $this->cart['total'] += $amount;
        $this->cart['items'] = $items;
        Session::put('cart', $this->cart);
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);
    }

    public function clearCart() {
        Session::flush();
        return redirect()->route('store'); 
    }
}

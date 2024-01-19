<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\items; 

class StoreController extends Controller {
    public function __construct() {
        $this->products = items::getProducts();
        
        $this->cart = [
            'total' => 0,
            'items' => []
        ];
    }
    
    public function index() {
        $this->cart = Session::get('cart', $this->cart);
        $this->products = items::getProducts();
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);
    }
    
    public function handleRequest(Request $request) {
        $productsToAdd = $request->except('_token', 'addToCart', 'removeFromCart');
        if ($request['addProduct']) {
            return $this->addProduct($request);
        } elseif ($request['addToCart']) {
            return $this->addToCart($request);
        } else {
            return $this->removeFromCart($request);
        }
    }

    public function addToCart(Request $request) {
        $this->cart = Session::get('cart', $this->cart);      
        $items = $this->cart['items'];
        $productsToAdd = $request->except('_token', 'addToCart');
        $totalAmount = 0;
        foreach (array_keys($productsToAdd) as $productID) {
            $amount = $productsToAdd[$productID];
            $totalAmount += $amount;
            if (!isset($items[$productID])) {
                $items[$productID] = $amount;
            } else {
                $items[$productID] += $productsToAdd[$productID];
            }
        }
        $this->cart['total'] += $totalAmount;
        $this->cart['items'] = $items;
        Session::put('cart', $this->cart);
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);
    }

    public function removeFromCart(Request $request) {
        $this->cart = Session::get('cart', $this->cart);      
        $items = $this->cart['items'];
        $productsToBeRemoved = $request->except('_token', 'removeFromCart');
        foreach (array_keys($productsToBeRemoved) as $productID) {
            if (isset($items[$productID])) {
                $items[$productID] -= $productsToBeRemoved[$productID];
                $this->cart['total'] -= $productsToBeRemoved[$productID];
                if ($items[$productID] >= 0) {
                    unset($items[$productID]);
                }
            }
        }
        $this->cart['items'] = $items;
        Session::put('cart', $this->cart);
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);

    }

    public function clearCart() {
        Session::flush();
        return redirect()->route('store'); 
    }

    public function addProduct(Request $request) {
        $productValuesToBeAdded = $request->except('_token', 'addProduct');
        items::createProduct($productValuesToBeAdded['productID'], $productValuesToBeAdded['productName'], $productValuesToBeAdded['productPrice']);
        return view('store', ['products' => $this->products, 'cart' => $this->cart]);
    }

}

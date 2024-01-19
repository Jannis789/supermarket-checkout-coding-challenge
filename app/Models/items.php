<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    protected $fillable = [
        'id', 'name', 'price'
    ];

    public static function getProducts()
    {
        return [
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
    }
}


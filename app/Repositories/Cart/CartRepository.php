<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\Repository;

class CartRepository extends Repository implements CartRepositoryInterface
{
    public function getModel()
    {
        return Cart::class;
    }
 
}

<?php

namespace App\Repositories\Shoping;

use App\Models\Cart;
use App\Models\Shoping;
use App\Repositories\Repository;

class ShopingRepository extends Repository implements ShopingRepositoryInterface
{
    public function getModel()
    {
        return Shoping::class;
    }
}

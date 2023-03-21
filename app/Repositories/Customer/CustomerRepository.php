<?php

namespace App\Repositories\Customer;

use App\Models\User;
use App\Repositories\Repository;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
 
}

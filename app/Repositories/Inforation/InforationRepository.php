<?php

namespace App\Repositories\Inforation;

use App\Models\Information;
use App\Repositories\Repository;

class InforationRepository extends Repository implements InforationRepositoryInterface
{
    public function getModel()
    {
        return Information::class;
    }
 
}

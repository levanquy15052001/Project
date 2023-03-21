<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'tbl_brand_product';

    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'id_user_add');
    }
}

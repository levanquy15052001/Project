<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoping extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'customer_id',
        'id_information',
        'qty',
        'qty',
    ];

    public $timestamps = true;

    public $table = 'tbl_shopping';
   
    public function shoping_has_information()
    {
        return $this->hasOne(Information::class,'customer_id','customer_id');

    }
    public function shoping_has_product()
    {

        return $this->belongsTo(Product::class,'product_id','product_id');

    }

    public function shoping_has_customer()
    {

        return $this->belongsTo(User::class,'customer_id','id');

    }
}

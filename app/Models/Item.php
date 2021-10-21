<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    public function saleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::class);
    }
    public function purchaseOrderLines()
    {
        return $this->hasMany(PoLine::class);
    }
}

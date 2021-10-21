<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    public function saleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrderLine extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'color_code');
    }
    public function saleOrder()
    {
        return $this->belongsTo(SaleOrder::class);
    }
}

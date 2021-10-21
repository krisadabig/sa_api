<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $timestamps = false;

    public function poLines()
    {
        return $this->hasMany(PoLine::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

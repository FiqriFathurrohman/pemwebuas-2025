<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'vehicle_category_id');
    }
}

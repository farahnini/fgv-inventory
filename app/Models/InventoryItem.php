<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'weight',
        'quantity',
        'category_id'
    ];

    public function inventoryCategory() 
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }
}

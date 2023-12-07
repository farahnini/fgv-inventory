<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class,'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemSetting extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'minimum_number_item_alert'];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class,'item_id');
    }
}

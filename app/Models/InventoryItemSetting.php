<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Laravel\Sanctum\HasApiTokens;

class InventoryItemSetting extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['item_id', 'minimum_number_item_alert'];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class,'item_id');
    }
}

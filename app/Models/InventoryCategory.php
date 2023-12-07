<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class InventoryCategory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class,'category_id');
    }
}

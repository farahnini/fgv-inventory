<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventoryItems()
    {                               // MODEL    // INTERMEDIARY TABLE  // FK        // PK FK
        return $this->belongsToMany(InventoryItem::class, 'item_order', 'order_id', 'item_id')->withPivot('quantity');
    }
}

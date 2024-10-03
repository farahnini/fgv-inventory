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
        'category_id',
        'image'
    ];

    public function inventoryCategory() 
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    // $inventory_item->image_url
    public function getImageUrlAttribute()
    {
        if($this->image){
            return asset('/storage/'.$this->image);
        }

        return 'https://www.fgvholdings.com/wp-content/uploads/2019/11/placeholder-logo.png';
    }

    // item -> setting HasOne, FK inventory_item_id -> item_id
    public function inventoryItemSetting()
    {                       // MODEL                       // FK        // PK
        return $this->hasOne(InventoryItemSetting::class, 'item_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'item_order', 'item_id')->withPivot('quantity');
    }
}

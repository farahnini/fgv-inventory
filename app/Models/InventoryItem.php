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
}

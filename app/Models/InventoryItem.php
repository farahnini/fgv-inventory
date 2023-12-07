<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Laravel\Sanctum\HasApiTokens;

class InventoryItem extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'weight',
        'colour',
        'reference_number',
        'quantity',
        'image',
    ];

    public function inventoryCategory()
    {
        return $this->belongsTo(InventoryCategory::class,'category_id');
    }

    public function getImageUrlAttribute()
    {   
        if($this->image){
            return asset('storage/'.$this->image);
        }
            return asset('images/no-image.png');

    }

    public function inventoryItemSetting()
    {       // MODEL                                        //FK        //PK
        return $this->hasOne(InventoryItemSetting::class,'item_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'item_order','item_id','order_id')->withPivot('quantity');
    }
}

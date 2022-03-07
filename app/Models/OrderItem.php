<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function order()
{
    return $this->belongsTo(OrderItem::class, 'order_id');
}

    public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_item_id');
}

}

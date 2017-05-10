<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';

    public function orderList()
    {
        //$count = Order::where('store_id', '1507')->count();
    }
}

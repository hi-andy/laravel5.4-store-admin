<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'return_goods';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

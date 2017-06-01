<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //
    protected $table        = 'store_withdrawal';
    protected $primaryKey   = 'sw_id';
    public    $timestamps   = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigiOrders extends Model
{
    protected $table = 'digitizing_orders';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

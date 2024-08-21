<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    protected $table = 'salesperson';
    protected $primaryKey = 'SalesPersonID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table = 'currencies';
    protected $primaryKey = 'CurrencyID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

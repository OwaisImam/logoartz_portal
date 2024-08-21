<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $primaryKey = 'CountryID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

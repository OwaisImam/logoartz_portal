<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vector_order extends Model
{
    protected $table = 'vector_order';
    protected $primaryKey = 'VectorOrderID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

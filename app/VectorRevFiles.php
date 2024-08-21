<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VectorRevFiles extends Model
{
    protected $table = 'vector_customer_rev_files';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

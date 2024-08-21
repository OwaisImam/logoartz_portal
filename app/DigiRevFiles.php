<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigiRevFiles extends Model
{
    protected $table = 'digi_customer_rev_files';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designers extends Model
{
    protected $table = 'designers';
    protected $primaryKey = 'DesignerID';
    public $timestamps = false;
    const CREATED_AT = 'DateAdded';
    const UPDATED_AT = 'DateModified';
}

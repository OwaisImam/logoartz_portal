<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VectorRevision extends Model
{
    protected $table = 'vector_revision';
    protected $primaryKey = 'RevisionID';
    public $timestamps = false;
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';
}

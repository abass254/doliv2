<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    //
    
    protected $fillable = [
        'doc', 'comment', 'creator', 'status'
    ];
}

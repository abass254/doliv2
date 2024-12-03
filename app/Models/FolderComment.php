<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderComment extends Model
{
    //
    protected $fillable = [
        'folder', 'comment', 'creator', 'status'
    ];
}


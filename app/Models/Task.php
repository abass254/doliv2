<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $fillable = [
        'ts_activity', 'ts_file', 'ts_status', 'time_taken', 'ts_user', 'ts_date', 'ts_time', 'ts_ref', 'ts_start', 'ts_end'
    ];
}

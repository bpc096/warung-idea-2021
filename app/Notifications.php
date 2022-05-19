<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'title', 'from', 'to', 'content', 'is_read'
    ];
}

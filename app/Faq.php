<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */

    protected $guarded = [];

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
}

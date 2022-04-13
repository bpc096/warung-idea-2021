<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */

    protected $guarded = [];

    public function scopeCampaign($query, $id)
    {
        return $query->where('campaign_id', $id);
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
}

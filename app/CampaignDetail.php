<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'users_id', 'status'];

    public function campaigns(){
        return $this->hasMany(Campaign::class,'id', 'campaign_id');
    }

    public function users(){
        return $this->hasMany(User::class, 'id', 'users_id');
    }
}

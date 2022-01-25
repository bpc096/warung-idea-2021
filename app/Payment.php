<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'campaign_id', 'users_id', 'reward_id', 'amount', 'status', 'snap_token'
    ];

    /**
     * campaign
     *
     * @return void
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

     /**
     * reward
     *
     * @return void
     */
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * getCreatedAtAttribute
     *
     * @param  mixed $date
     * @return void
     */
    public function getCreatedAtAttribute($date)
    {   
        return Carbon::parse($date)->format('d-M-Y');
    }
    
    /**
     * getUpdatedAtAttribute
     *
     * @param  mixed $date
     * @return void
     */
    public function getUpdatedAtAttribute($date)
    {   
        return Carbon::parse($date)->format('d-M-Y');
    }
}

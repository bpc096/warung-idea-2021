<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    //  /**
    //  * The table associated with the model.
    //  *
    //  * @var string
    //  */
    // protected $table = 'collaborations';
    protected $casts = [
        'collaborators' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign_id', 'owner_id', 'collaborators'];


    /**
     * Query scope to return information about the current project or campaign
     * @param  [type] $query [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function scopeCampaign($query, $id)
    {
        return $query->where('campaign_id', $id);
    }

    /**
     * Get the user that is a collaborator on another project
     * @return collection
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'collaborator_id');
    // }

    public function owner()
    {
        return $this->belongsTo(Campaign::class, 'users_id');
    }

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class, 'id');
    }
}

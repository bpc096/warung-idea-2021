<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['users_id', 'category_id', 'title', 'slug', 'short_description', 'target_donation', 'max_date', 'description', 'project_plan', 'collaborators', 'image'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function rewards(){
        return $this->hasMany(Reward::class);
    }

    public function updates(){
        return $this->hasMany(Update::class);
    }

    public function faqs(){
        return $this->hasMany(Faq::class);
    }

    public function details() {
        return $this->hasMany(CampaignDetail::class, 'campaign_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class, 'campaign_id');
    }

    protected $casts = [
        'collaborators' => 'array'
    ];

    /**
     * sumPayment
     *
     * @return void
     */
    public function sumPayment()
    {
        return $this->hasMany(Payment::class)->selectRaw('payments.campaign_id,SUM(payments.amount) as total')->where('payments.status', 'success')->groupBy('payments.campaign_id');
    }

    /**
     * mostFunding
     *
     * @return void
     */
    // public function mostFunding()
    // {
    //     return $this->hasMany(Payment::class)->selectRaw('payments.campaign_id,SUM(payments.amount) as total')->where('payments.status', 'success')->groupBy('payments.campaign_id')->orderBy('SUM(payments.amount) as total', 'desc');
    // }    

    public function percent_raised(){
        $raised = $this->hasMany(Payment::class)->selectRaw('payments.campaign_id,SUM(payments.amount) as total')->where('payments.status', 'success')->groupBy('payments.campaign_id');
        $goal = $this->target_donation;

        $percent = 0;
        if ($raised > 0){
            $percent = round(($raised * 100) / $goal, 0, PHP_ROUND_HALF_DOWN);
        }
        return $percent;
    }

    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/campaigns/'.$image);
    }
}

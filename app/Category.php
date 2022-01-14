<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'category_slug', 'category_image'
    ];

    /**
     * campaign
     *
     * @return void
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/categories/'.$image);
    }

    // public function getRouteKeyName()
    // {
    //     return 'category_name';
    // }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\RecommendReview;

class Recommend extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'body',
        'image_url', 
        'star',
    ];

    /**
     * Get the user that owns the recommend.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
    public function recommend_reviews()   
    {
        return $this->hasMany(RecommendReview::class);  
    }
}

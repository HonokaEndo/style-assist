<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Recommend;
use App\Models\RecommendReview;

class RecommendReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'recommend_id',          // recommends_id を recommend_id に修正
        'recommend_review_id',   // recommends_review_id を recommend_review_id に修正
        'user_id',
        'star',
        'comment',
    ];
    /**
     * Get the user that owns the recommend review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function recommend()
    {
        return $this->belongsTo(Recommend::class);
    }
    public function recommend_review()
    {
        return $this->belongsTo(RecommendReview::class, 'recommend_review_id');
    }
    public function replies()
    {
        return $this->hasMany(RecommendReview::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(RecommendReview::class, 'parent_id');
    }

}

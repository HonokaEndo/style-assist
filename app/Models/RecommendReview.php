<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Recommend;

class RecommendReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'recommends_id',
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
    
}

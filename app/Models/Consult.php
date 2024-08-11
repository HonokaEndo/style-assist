<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ConsultReview;

class Consult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'body',
        'image_url', 
    ];

    /**
     * Get the user that owns the consult.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function consult_reviews()   
    {
        return $this->hasMany(ConsultReview::class);  
    }
}

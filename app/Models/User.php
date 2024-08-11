<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function consults()   
    {
        return $this->hasMany(Consult::class);  
    }
    public function consult_reviews()   
    {
        return $this->hasMany(ConsultReview::class);  
    }
    public function recommend()   
    {
        return $this->hasMany(Recommend::class);  
    }
    public function recommend_reviews()   
    {
        return $this->hasMany(RecommendReview::class);  
    }
    public function my_coordinations()   
    {
        return $this->hasMany(MyCoordination::class);  
    }
    
}


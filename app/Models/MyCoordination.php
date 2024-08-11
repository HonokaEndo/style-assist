<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Day;

class MyCoordination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'picture',
        'day_id',
    ];

    /**
     * Get the user that owns the coordination.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}

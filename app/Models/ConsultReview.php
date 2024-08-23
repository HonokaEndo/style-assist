<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Consult;
use App\Models\ConsultReview;


class ConsultReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'consult_id',          // consults_id を consult_id に修正
        'user_id',
        'comment',
        'parent_id', // これを追加して、親コメントのIDを設定できるようにします
    ];
    /**
     * Get the user that owns the consult review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function consult()
    {
        return $this->belongsTo(Consult::class, 'consult_id');
    }
    public function replies()
    {
        return $this->hasMany(ConsultReview::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ConsultReview::class, 'parent_id');
    }
}
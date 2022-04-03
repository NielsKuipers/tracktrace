<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserTrackingCode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function trackingCode(): BelongsToMany
    {
        return $this->belongsToMany(TrackingCode::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackingCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}

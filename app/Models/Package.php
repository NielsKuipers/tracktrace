<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pickup(): HasOne
    {
        return $this->hasOne(Pickup::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company');
    }
}

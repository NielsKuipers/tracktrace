<?php

namespace App\Models;

use App\Http\Controllers\TrackingController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query->where(fn($query) => $query->whereHas('company', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->orWhere('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('zipcode', 'like', '%' . $search . '%')
            ->orWhere('street', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%')
            ->orWhere('country', 'like', '%' . $search . '%')
        ));

        $query->when($filters['sort'] ?? false, fn($query, $sort) => $query
            ->orderBy($sort, $filters['order'])
        );
    }

    public
    function pickup(): HasOne
    {
        return $this->hasOne(Pickup::class);
    }

    public
    function label(): HasOne
    {
        return $this->hasOne(Label::class);
    }

    public
    function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function trackingCode(): HasOne
    {
        return $this->hasOne(TrackingCode::class);
    }
}

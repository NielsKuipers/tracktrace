<?php

namespace App\Http\Controllers;

use App\enums\PackageStatus;
use App\Models\Package;
use App\Models\Review;
use App\Models\TrackingCode;
use App\Models\UserTrackingCode;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TrackingController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('tracking.create');
    }

    public function show($id)
    {
        return view('tracking.show', [
            'package' => Package::with(['company', 'trackingCode'])->where('id', $id)->get()->first()
        ]);
    }

    public function review($id)
    {
        request()->validate([
            'rating' => ['required', 'min:1', 'max:5'],
            'comment' => ['string']
        ]);

        Review::create([
            'package_id' => $id,
            'user_id' => request()->user()->id,
            'rating' => request()->input('rating'),
            'comment' => request()->input('comment')
        ]);
    }

    public function store()
    {
        request()->validate([
            'code' => ['required', 'string']
        ]);

        if (!$code = TrackingCode::where('tracking_code', request()->input('code'))->first())
            throw ValidationException::withMessages(['code' => 'Please enter a valid code']);
        else {
            UserTrackingCode::create([
                'package_id' => $code->package_id,
                'user_id' => request()->user()->id
            ]);
        }

//        return redirect(route(''))->with('success', 'Pickup successfully created');
    }
}

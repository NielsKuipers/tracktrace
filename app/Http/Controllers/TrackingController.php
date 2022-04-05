<?php

namespace App\Http\Controllers;

use App\enums\PackageStatus;
use App\Models\Package;
use App\Models\Review;
use App\Models\TrackingCode;
use App\Models\UserTrackingCode;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;


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
        if (!UserTrackingCode::where(['package_id' => $id, 'user_id' => \request()->user()->id])->exists()) {
            abort(401);
        }

        return view('tracking.show', [
            'package' => Package::with(['company', 'trackingCode'])->where('id', $id)->get()->first(),
            'reviewed' => Review::where(['package_id' => $id, 'user_id' => request()->user()->id])->exists()
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

        return redirect(route('tracking.show', $id))->with('success', 'Transaction reviewed successfully!');
    }

    public function store()
    {
        request()->validate([
            'code' => ['required', 'string']
        ]);

        //check if tracking code is valid
        if (!$code = TrackingCode::where('tracking_code', request()->input('code'))->first())
            throw ValidationException::withMessages(['code' => 'Please enter a valid code']);
        //if code isn't already linked to user
        elseif (UserTrackingCode::where(['package_id' => $code->package_id, 'user_id' => request()->user()->id])->doesntExist()) {
            UserTrackingCode::create([
                'package_id' => $code->package_id,
                'user_id' => request()->user()->id
            ]);
        }

        return redirect(route('tracking.show', $code->package_id));
    }
}

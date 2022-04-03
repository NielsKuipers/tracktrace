<?php

namespace App\Http\Controllers;

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

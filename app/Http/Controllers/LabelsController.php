<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class LabelsController extends Controller
{
    public function create()
    {
//        return view('packages.labels', [
//            'packages' => Package::with('company')->get()
//        ]);
        return Browsershot::url('http://google.com')->noSandbox()->timeout(360)->screenshot();
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessBrowsershot;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class LabelsController extends Controller
{
    public function create()
    {
        return view('packages.labels', [
            'packages' => Package::with('company')->where('status', 'logged')->get()
        ]);
    }

    public function generateLabel()
    {
        Bus::chain([
            new ProcessBrowsershot('http://localhost:80/api/packages/labels'),
        ])->dispatch();
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessBrowsershot;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;

class LabelsController extends Controller
{
    public function create()
    {
        return view('labels.labels', [
            'packages' => Package::with('company')->where('status', 'logged')->get()
        ]);
    }

    public function store()
    {
        $this->generateLabel(request()->input('toPrint')[0]);

//        foreach (request()->input('toPrint') as $item) {
//            $this->generateLabel($item);
//        }
    }

    public function view($id)
    {
        $qrcode = QrCode::generate('yo');

        return view('labels.view', [
            'package' => Package::with('company')->where('id', $id)->get()->first(),
            'qrcode' => $qrcode
        ]);
    }

    public function generateLabel($packageId)
    {
        Bus::chain([
            new ProcessBrowsershot('http://localhost:80/packages/label/' . $packageId),
        ])->dispatch();
    }
}

<?php

namespace App\Http\Controllers;

use App\enums\PackageStatus;
use App\Jobs\ProcessBrowsershot;
use App\Models\Label;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LabelsController extends Controller
{
    public function create(): View
    {
        return view('labels.printable_labels', [
            'packages' => Package::with('company')->where('status', PackageStatus::LOGGED->toString())->get()
        ]);
    }

    public function store()
    {
        foreach (request()->input('toPrint') as $item) {
            $this->generateLabel($item);
        }
    }

    public function view($id): View
    {
        $qrcode = QrCode::generate('yo');

        return view('labels.view', [
            'package' => Package::with('company')->where('id', $id)->get()->first(),
            'qrcode' => $qrcode
        ]);
    }

    public function viewAll(): View
    {
        return view('labels.labels', [
            'packages' => Package::with('company')
                ->where('status', '!=', PackageStatus::LOGGED->toString())
                ->filter(request(['search']))->get()
        ]);
    }

    public function generateLabel($packageId)
    {
        Package::where('id', $packageId)->update(['status' => PackageStatus::PRINTED->toString()]);
        ProcessBrowsershot::dispatch('http://localhost:80/packages/label/', $packageId);
    }

    public function labelToPDF()
    {
        $ids = request()->input('toProcess');
        $labels = Label::whereIn('package_id', $ids)->get();
        $htmlstring = '';

        foreach ($labels as $label) {
            $htmlstring = $htmlstring . '<img src="data:image/png;base64,' . $label->label_image . '"/> <br><br>';
        }

        $pdf = PDF::loadHTML($htmlstring);
        return $pdf->stream();
    }
}

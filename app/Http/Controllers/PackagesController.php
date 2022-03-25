<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function create()
    {
        return view('packages.create');
    }

    public function createCSV()
    {
        return view('packages.create', [
            'isCSV' => true
        ]);
    }

    public function store()
    {
        if (request()->file() != null) {
            $this->parseCSV(request()->file('csvfile')->path());
            return redirect(route('packages.log.csv'))->with('success', 'Package(s) successfully added');
        }

        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'country' => ['required'],
            'zipcode' => ['required'],
            'building_number' => ['required'],
            'street' => ['required'],
            'city' => ['required'],
            'weight' => ['required'],
        ]);

        $company = ['company' => Auth::user()->company];
        $result = array_merge($attributes, $company);

        Package::create($result);
        return redirect(route('packages.log'))->with('success', 'Package successfully added');
    }

    private function parseCSV($filepath)
    {
        $file = fopen($filepath, 'r');
        $header = fgetcsv($file);
        $header[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $header[0]);
        $result = array();
        $company = Auth::user()->company;

        $i = 0;
        while ($row = fgetcsv($file)) {
            $result[] = array_combine($header, $row);
            $result[$i] = array_merge($result[$i], ['company' => $company, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            $i++;
        }

        Package::insert($result);
    }
}

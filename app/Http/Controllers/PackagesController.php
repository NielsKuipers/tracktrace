<?php

namespace App\Http\Controllers;

use App\enums\PackageStatus;
use App\Models\Package;
use App\Models\Pickup;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\ValidationException;

class PackagesController extends Controller
{
    public function create()
    {
        return view('packages.create', [
            'isCSV' => false
        ]);
    }

    public function createCSV()
    {
        return view('packages.create', [
            'isCSV' => true
        ]);
    }

    public function index()
    {
        $dir = 'asc';
        if (request()->query('order') == 'asc')
            $dir = 'desc';

        return view('packages.index', [
            'packages' => Package::where('status', PackageStatus::SENT->toString())->filter(request(['search', 'sort', 'order']))->paginate(9),
            'dir' => $dir
        ]);
    }

    public function createPickup()
    {
        return view('packages.pickup', [
            'packages' => Package::with('company')
                ->where('status', PackageStatus::PRINTED->toString())
                ->filter(request(['search']))->get()
        ]);
    }

    public function storePickup()
    {
        $today = Carbon::today();

        $attributes = \request()->validate([
            'time' => ['required', 'date', 'after:' . $today],
            'zipcode' => ['required', 'string'],
            'building_nr' => ['required'],
            'country' => ['required', 'string']
        ]);

        $dt = Carbon::parse(request()->input('time'));

        if($today->day + 1 >= $dt->day)
        {
            $currentTime = new DateTime('now', new DateTimeZone('Europe/Amsterdam'));
            $lockout = new DateTime('now', new DateTimeZone('Europe/Amsterdam'));
            date_time_set($lockout, 15, 00);

            if ($currentTime > $lockout)
                throw ValidationException::withMessages(['time' => 'Time has to be set before 3:00 PM on the day before the date']);
        }

        if (!request()->has('toProcess'))
            throw ValidationException::withMessages(['packages' => 'Please select packages to process']);

        foreach (request()->input('toProcess') as $item) {
            $attributes['package_id'] = $item;
            Pickup::create($attributes);
        }

        Package::whereIn('id', request()->input('toProcess'))->update(['status' => PackageStatus::SORTING->toString()]);

        return redirect(route('packages.pickup'))->with('success', 'Pickup successfully created');
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

        $company = ['company_id' => Auth::user()->company];
        $result = array_merge($attributes, $company);

        Package::create($result);
        return redirect(route('packages.log'))->with('success', 'Package successfully added');
    }

    public function storeAPI()
    {
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'country' => ['required'],
            'zipcode' => ['required'],
            'building_number' => ['required'],
            'street' => ['required'],
            'city' => ['required'],
            'weight' => ['required'],
            'company_id' => ['required', 'integer']
        ]);

        Package::create($attributes);

        return response('Package created', 201);
    }

    private function parseCSV($filepath)
    {
        $file = fopen($filepath, 'r');
        $header = fgetcsv($file);
        $header[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $header[0]);
        $result = array();

        $i = 0;
        while ($row = fgetcsv($file)) {
            $result[] = array_combine($header, $row);
            $result[$i] = array_merge($result[$i], ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            $i++;
        }

        Package::insert($result);
    }

    public function updateStatus($id)
    {
        $status = request()->input('status');
        Package::where('id', $id)->update(['status' => $status]);

        return response('Update successful!', 201);
    }
}

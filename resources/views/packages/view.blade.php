@extends('layouts.app', ['title' => 'Package'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <p>{{ $package->company->name }}</p>
                        <p>{{ $package->company->street }} {{ $package->company->building_number }}</p>
                        <p>{{ $package->company->zipcode }} {{ $package->company->city }}</p>
                        <p>{{ $package->company->country }}</p>
                    </div>

                    <div class="overflow-hidden ">
                        <p>{{ $package->first_name }} {{ $package->last_name }}</p>
                        <p>{{ $package->street }} {{ $package->building_number }}</p>
                        <p>{{ $package->zipcode }} {{ $package->city }}</p>
                        <p>{{ $package->country }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

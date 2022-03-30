@extends('layouts.app', ['title' => 'Package'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col align-middle items-center">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle p-2">
                    <div class="overflow-hidden ">
                        <p class="text-1xl font-bold">From:</p>
                        <p>{{ $package->company->name }}</p>
                        <p>{{ $package->company->street }} {{ $package->company->building_number }}</p>
                        <p>{{ $package->company->zipcode }} {{ $package->company->city }}</p>
                        <p>{{ $package->company->country }}</p>
                    </div>

                    <div class="spacer"></div>

                    <div class="overflow-hidden ">
                        <p class="text-1xl font-bold">To:</p>
                        <p>{{ $package->first_name }} {{ $package->last_name }}</p>
                        <p>{{ $package->street }} {{ $package->building_number }}</p>
                        <p>{{ $package->zipcode }} {{ $package->city }}</p>
                        <p>{{ $package->country }}</p>
                    </div>

                    <div class="spacer"></div>

                    <div class="overflow-hidden ">
                        <div class="flex">
                            <p class="text-1xl font-bold mr-0.5">Weight:</p>
                            <p>{{ $package->weight }} kg</p>
                        </div>
                        <div class="flex">
                            <p class="text-1xl font-bold mr-0.5">Sender reference:</p>
                            <p> {{ $package->id }}</p>
                        </div>
                    </div>

                    <div class="spacer"></div>

                    <div class="">
                        {{ $qrcode }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

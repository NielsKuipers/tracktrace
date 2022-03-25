@extends('layouts.app', ['title' => 'Packages'])

@section('content')
    @component("components.alerts") @endcomponent
    <form method="POST" enctype="multipart/form-data" action="{{ route('packages.log') }}">
        @csrf

        @if($isCSV)
            <h3>Upload your CSV file</h3>

            <div class="row">
                <label class="col-6">
                    <input name="csvfile" type="file"
                           accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .xls, .csv"
                           value="{{ old('file') }}" required>
                    @error('file')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>

                <label class="col-2">
                    <button type="submit" class="btn btn-primary">Log packages</button>
                </label>
            </div>
        @else
            <div class="row">
                <label class="col-6">
                    <input name="first_name" type="text" placeholder="Receiver name" value="{{ old('first_name') }}"
                           required>
                    @error('first_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>

                <label class="col-6">
                    <input name="last_name" type="text" placeholder="Receiver last name" value="{{ old('last_name') }}"
                           required>
                    @error('last_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>
            </div>

            <div class="row">
                <label class="col-4">
                    <input name="country" type="text" placeholder="Country" value="{{ old('country') }}" required>
                    @error('country')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>

                <label class="col-4">
                    <input name="zipcode" type="text" placeholder="Zipcode" value="{{ old('zipcode') }}" required>
                    @error('zipdode')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>

                <label class="col-4">
                    <input name="building_number" type="text" placeholder="Building number"
                           value="{{ old('building_number') }}" required>
                    @error('building_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>
            </div>

            <div class="row">
                <label>
                    <input name="street" type="text" placeholder="Street name" value="{{ old('street') }}" required>
                    @error('street')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>
            </div>

            <div class="row">
                <label>
                    <input name="city" type="text" placeholder="City" value="{{ old('city') }}" required>
                    @error('city')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>
            </div>


            <div class="row">
                <label>
                    <input name="weight" type="number" step="0.01" placeholder="Package weight (KG)"
                           value="{{ old('weight') }}" required>
                    @error('weight')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </label>
            </div>

            <div class="row">
                <label class="col-1">
                    <button type="submit" class="btn btn-primary">Log package</button>
                </label>
            </div>
        @endif
    </form>
@endsection

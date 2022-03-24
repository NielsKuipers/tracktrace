@extends('layouts.app', ['title' => 'Packages'])

@section('content')
    @component("components.alerts") @endcomponent
    <form method="POST" action="{{ route('packages.log') }}">
        <div class="row">
            <label class="col-6">
                <input name="first_name" type="text" placeholder="Receiver name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </label>

            <label class="col-6">
                <input name="last_name" type="text" placeholder="Receiver last name" value="{{ old('last_name') }}" required>
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
                <input name="building_number" type="number" placeholder="Building number" value="{{ old('building_number') }}" required>
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
                <input name="weight" type="number" placeholder="Package weight (KG)" value="{{ old('weight') }}" required>
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
    </form>
@endsection

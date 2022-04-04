@extends('layouts.app', ['title' => 'Track n trace'])
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col align-middle items-center">
            <p class="">Track n trace code</p>
            <p class="text-xl"> {{ $package->trackingCode->tracking_code }} </p>

            <div class="spacer"></div>

            <p class="text-xl font-bold">Package status: {{ $package->status }}</p>

            <div class="spacer"></div>

            <div class="overflow-hidden ">
                <p class="text-1xl font-bold">Postal address:</p>
                <p>{{ $package->street }} {{ $package->building_number }}</p>
                <p>{{ $package->zipcode }} {{ $package->city }}</p>
            </div>

            <div class="spacer"></div>

            @if($package->status == \App\enums\PackageStatus::FINISHED->toString())
                <form action="{{route('tracking.review', [$package->id])}}" method="POST">
                    @csrf
                    <div class="relative z-0 mb-6 w-full">
                        <p class="text-3xl text-grey-dark leading-loose w-full">How would you rate this delivery?</p>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="number" min="1" max="5" name="rating"
                               class="block py-2.5 px-0 w-10 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="rating"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            1-5</label>
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="relative z-0 mb-6 w-full group">
                        <textarea name="comment"
                                  class="block height-100 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" ">
                        </textarea>
                        <label for="comment"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Extra comments</label>
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit"
                            class="bg-blue-500 rounded-lg font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600">
                        Submit review
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.app', ['title' => 'Track package'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <form action="{{route('tracking.store')}}" method="POST">
            @csrf
            <div class="relative z-0 mb-6 w-full">
                <p class="text-3xl text-grey-dark leading-loose w-full">Enter your track n trace code</p>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="code"
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                       placeholder=" " required/>
                <label for="code"
                       class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Track n trace code</label>
                @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit"
                    class="bg-blue-500 rounded-lg font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600">
                Track package
            </button>
        </form>
    </div>
@endsection

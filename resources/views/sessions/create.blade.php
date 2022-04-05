@extends('layouts.app', ['title' => 'Login'])

@section('content')
    @component("components.alerts") @endcomponent
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <form id="Login" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col offset-md-2">
                        <h4 class="font-size-125 font-strong">Log in</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 offset-md-2">
                        <input name="email" type="email" placeholder="E-mail..."
                               value="{{ old('email') }}"
                               class="@error('email') is-invalid @enderror" required>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-12 col-md-3 offset-md-2">
                        <input name="password" type="password" placeholder="Password..."
                               value="{{ old('password') }}"
                               class="@error('password') is-invalid @enderror" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
								    <strong>{{ $message }}</strong>
							    </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-2 offset-md-2">
                    <button name="login" type="submit" class="btn btn-primary">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

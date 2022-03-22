@extends('layouts.app', ['title' => 'Register'])

@section('content')
    @component("components.alerts") @endcomponent
    <div class="container-fluid">
        <div class="mx-40px">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <form id="register" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col offset-md-2">
                                <h4 class="font-size-125 font-strong">Account</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-2 offset-md-2">
                                <input name="name" type="text" placeholder="First name..." value="{{ old('name') }}"
                                       class="@error('name') is-invalid @enderror" required>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
                            @enderror

                            <div class="col-12 col-md-2">
                                <input name="lastName" type="text" placeholder="Lirst name..."
                                       value="{{ old('lastName') }}"
                                       class="@error('lastName') is-invalid @enderror" required>
                            </div>
                            @error('lastName')
                            <span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Forgot Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('successmessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('successmessage')}}
                    </div>
                    @endif
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$error}}
                        </div>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ route('send_otp') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-end">{{ __('Phone No') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="phone_no" autofocus>

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send OTP') }}
                                </button>

                                
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

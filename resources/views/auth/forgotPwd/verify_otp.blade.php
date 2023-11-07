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
                    <div class="alert alert-success alert-dismissible fade show" id="success_msgo" role="alert">
                        {{session('successmessage')}}
                    </div>
                    @endif
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" id="error_msgo" role="alert">
                            {{$error}}
                        </div>
                        @endforeach
                    @endif
                    <div class="" id="success_msg"></div>
                    <div class="" id="error_msg"></div> 
                    <form method="POST" action="{{ route('verify_otp') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="remember_token" class="col-md-4 col-form-label text-md-end">{{ __('Enter OTP') }}</label>

                            <div class="col-md-6">
                                <input id="remember_token" type="text" class="form-control" name="remember_token" required autocomplete="remember_token" autofocus>
                            </div>
                            <div class="col-md-6 offset-md-4 mt-3">
                                <p id="reset_timer">Resend OTP in - <span id="timer"></span></p>
                                <a href="javascript:void(0);" id="resend_otp" onclick="resend()">Resend OTP Now</a>
                            </div>
                        </div>

                        <input type="hidden" name="token" id="token" value="{{($token) ? $token : ''}}">
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                                
                                <a class="btn btn-link" href="{{ route('forgot_password') }}">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let timerOn = true;

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;
        
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;
        
        if(remaining >= 0 && timerOn) {
            $("#resend_otp").hide();
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if(!timerOn) {
            // Do validate stuff here
            console.log('hhfhfhf');
            return;
        }
        
        // Do timeout stuff here
        // alert('Timeout for otp');
        $("#reset_timer").hide();
        $("#resend_otp").show();
    }

    timer(30);

    function resend () {
        $('#success_msgo').hide();
        $('#error_msgo').hide();
        // alert('resend otp');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            /* the route pointing to the post function */
            url: "{{ route('resend_otp') }}",
            type: 'POST',
            data: {_token: CSRF_TOKEN, token:$("#token").val()},
            dataType: 'JSON',
            success: function (data) { 
                if (data.status == 'success') {
                    $('#success_msg').addClass('alert alert-success');
                    $('#success_msg').html(data.msg);
                } else {
                    $('#error_msg').addClass('alert alert-danger');
                    $('#error_msg').html(data.msg);
                }
            }
        }); 

        $("#reset_timer").show();
        $("#resend_otp").hide();
        timer(30);
    }
</script>
<style>
    .hide { display: none; }
    .show { display: block; }
</style>
@endsection

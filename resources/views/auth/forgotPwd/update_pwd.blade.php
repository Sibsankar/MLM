@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Password') }}</div>

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
                    <form method="POST" action="{{ route('update_pwd') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <div style="border: 1px solid rgb(5 124 117); padding:15px">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">     
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">     
                                </div>
                                <input type="hidden" name="token" value="{{($token) ? $token : ''}}">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-xs btn-success mt-4">Update Password</button> 
                                </div>
                            </div>
                        </div>  
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

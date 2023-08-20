@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12S">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                    @if($user->pwd_status == 1)
                        <p class="h4">Edit Profile</p>
                        <!-- form start -->
                        <form method="POST" action="{{ route('updateProfile') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body">
                            <input type="hidden" id="referred_by" name="referred_by" value="{{ isset($sponsorDetails[0]->user_id) ? $sponsorDetails[0]->user_id : '' }}">
                        {{-- <div style="border: 1px solid rgb(5 124 117); padding:15px">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Sponsor Code</label>
                                    <input type="sponser_code" class="form-control" id="sponser_code" value="{{ isset($sponsorDetails[0]->sponsor_code) ? $sponsorDetails[0]->sponsor_code : '' }}" placeholder="Enter Sponsor Code">               
                                                
                                    
                                </div> 
                                <div class="col-md-6"><button type="button" class="btn btn-xs btn-success mt-4">Search</button> </div>
                            </div>
                            <div class="row" id="spDiv" >
                                <div class="form-group col-md-6">
                                    <label for="spName">Sponsor Name</label>
                                    <input type="text" class="form-control" id="spName" value="{{ isset($sponsorDetails[0]->associate_name) ? $sponsorDetails[0]->associate_name : '' }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="spRank">Sponsor Rank</label>
                                    <input type="text" class="form-control" id="spRank" value="{{ isset($sponsorDetails[0]->rank) ? $sponsorDetails[0]->rank : '' }}" readonly>
                                </div>

                            </div>
                        </div>   --}}


                            
                        <div class="form-group">
                            <label for="associate_name">Name of Associate</label>
                            <input type="text" class="form-control" name="associate_name" required id="associate_name" placeholder="Enter Name of Associate" value={{$user->details[0]->associate_name}}>
                        </div>
                        <div class="form-group">
                            <label for="associate_name">Associate Code</label>
                            <input type="text" class="form-control" readonly placeholder="Enter Name of Associate" value={{$user->details[0]->sponsor_code}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required value={{$user->email}}>
                        </div>
                            
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="dob" required data-target="#reservationdate" value={{date('m/d/Y', strtotime($user->details[0]->dob))}} >
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="rank">Rank</label>
                            <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter Rank" value={{$user->details[0]->rank}}>
                        </div>
                        <div class="form-group">
                            <label for="rank">Aadhar No</label>
                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" required placeholder="Enter Aadhar No" value={{$user->details[0]->aadhar_no }}>
                        </div>
                        <div class="form-group">
                            <label for="rank">Phone No</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" required placeholder="Enter Phone No" value={{$user->phone_no }} disabled>
                        </div>
                        <div class="form-group">
                            <label for="image">Photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="" id="image" name="image">
                                    <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                                </div>
                                <!-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                                </div> -->
                                @if($user->details[0]->image_path)
                                    <img src="{{$user->details[0]->image_path}}" width="100px"/>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value={{$user->id}}>
                        <!-- /.card-body -->

                        <div class="card-footer mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    @else
                    <p class="h4">Change Password</p>
                        <!-- form start -->
                        <form method="POST" action="{{ route('updatePwd') }}" enctype='multipart/form-data'>
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
                                    <input type="hidden" name="user_id" value={{$user->id}}>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-xs btn-success mt-4">Update Password</button> 
                                    </div>
                                </div>
                            </div>  
                        </form> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
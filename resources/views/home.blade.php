@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-left: 200px">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                <div col-md-3><a class="btn btn-xs btn-success mt-4" href="{{ route('generate-pdf') }}" target="_blank">Generate Pdf</a>
                <p style="color: red;">Please remember. Click generate PDF if you enter all the data correctly. Once you generate PDf then you will not be able to update your profile</p>
                </div>
                

                <div class="card-body" style="max-height:75vh; overflow-y:scroll;">
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
                            


                            
                        <div class="form-group">
                            <label for="associate_name">Name of Associate</label>
                            <input type="text" class="form-control" name="associate_name" required id="associate_name" placeholder="Enter Name of Associate" value="{{$user->details[0]->associate_name}}">
                        </div>
                        <div class="form-group">
                            <label for="associate_name">Associate Code</label>
                            <input type="text" class="form-control" readonly placeholder="Enter Name of Associate" value="{{$user->details[0]->sponsor_code}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required value="{{$user->email}}">
                        </div>
                            
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="dob" required data-target="#reservationdate" value="{{date('m/d/Y', strtotime($user->details[0]->dob))}}" >
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rank">Gender</label>
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="male" name="gender" value="Male" {{($user->details[0]->gender == 'Male') ? 'checked' : ''}}>
                            <label for="male" class="custom-control-label">Male</label>
                            </div>
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="female" name="gender" value="Female" {{($user->details[0]->gender == 'Female') ? 'checked' : ''}}>
                            <label for="female" class="custom-control-label">Female</label>
                            </div>
                        </div>
                            
                        {{-- <div class="form-group">
                            <label for="rank">Rank</label>
                            <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter Rank" value={{$user->details[0]->rank}}>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Select Rank</label>
                            <select id="rank" name="rank" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Select Rank</option>
                              @foreach($rankData as $ranks)
                              <option  value="{{$ranks->id}}" @if($sponsorDetails[0]->rank == $ranks->id) selected  @endif>{{$ranks->rank_name}}</option>
                              @endforeach
                              
                            </select>
                          </div> --}}
                          <div class="form-group">
                            <label for="rank">Rank</label>
                            <input type="text" class="form-control" id="" name="" readonly  value="{{ ($rankData) ? $rankData->rank_name : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Aadhar No</label>
                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" required placeholder="Enter Aadhar No" value="{{$user->details[0]->aadhar_no }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">PAN No</label>
                            <input type="text" class="form-control" id="pan_no" name="pan_no" required placeholder="Enter PAN No" value="{{$user->details[0]->pan_no }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Phone No</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" required placeholder="Enter Phone No" value="{{$user->phone_no }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="image">Photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="" id="image" name="image">
                                    <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                                    <p class="text-info">File type must be jpg, jpeg, png only</p>
                                </div>
                                <!-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                                </div> -->
                                @if($user->details[0]->image_path)
                                    <img src="{{$user->details[0]->image_path}}" width="100px"/>
                                @endif
                                
                            </div>
                        </div>
<h1>Personal Details</h1>
                        <div class="form-group">
                            <label for="rank">Father's /Husband's Name</label>
                            <input type="text" class="form-control" id="guardians_name" name="guardians_name" required placeholder="Enter Father's /Husband's Name" value="{{$user->details[0]->guardians_name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1" required placeholder="Enter Address" value="{{$user->details[0]->address_line1 }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Address Line 2</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2" required placeholder="Enter Address" value="{{$user->details[0]->address_line2 }}">
                        </div>
                        
                       
                        
                        <div class="form-group">
                            <label for="rank">Country</label>
                            <input type="text" readonly class="form-control" id="country_name" name="country_name" required placeholder="Enter country" value="India" disabled>
                        </div>

                        <div class="form-group">
                            <label>Select State</label>
                            <select id="State" name="state_name" class="form-control select2" style="width: 100%;" onchange="getCity(this.value)">
                              <option selected="selected">Select State</option>
                              @foreach($StateData as $states)
                              <option <?php if($states->state_code==$user->details[0]->state_name){echo 'selected'; } ?> value="{{$states->state_code}}" >{{$states->state_name}}</option>
                              @endforeach
                              
                            </select>
                          </div>
                          <input type="hidden" id="cityId" value="{{$user->details[0]->city_name }}">
                          <div class="form-group">
                            <label>Select City</label>
                            <select id="city_name" name="city_name" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Select City</option>
                              @foreach($cityData as $cities)
                              <option <?php if($cities->city_code==$user->details[0]->city_name){echo 'selected'; } ?> value="{{$cities->city_code}}" >{{$cities->city_name}}</option>
                              @endforeach
                              
                            </select>
                          </div>
                        {{-- <div class="form-group">
                            <label for="rank">State</label>
                            <input type="text" class="form-control" id="state_name" name="state_name" required placeholder="Enter state" value="{{$user->details[0]->state_name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">City</label>
                            <input type="text" class="form-control" id="city_name" name="city_name" required placeholder="Enter City" value="{{$user->details[0]->city_name }}">
                        </div> --}}
                        <div class="form-group">
                            <label for="rank">District</label>
                            <input type="text" class="form-control" id="district" name="district" required placeholder="Enter District" value="{{$user->details[0]->district }}">
                        </div>

                        <div class="form-group">
                            <label for="rank">Pin</label>
                            <input type="text" class="form-control" id="pin" name="pin" required placeholder="Enter pin" value="{{$user->details[0]->pin }}">
                        </div>

                        <h1>Nominee Details</h1>
                        <div class="form-group">
                            <label for="rank">Nominee Name</label>
                            <input type="text" class="form-control" id="nominee_Name" name="nominee_Name" required placeholder="Enter Nominee Name" value="{{$user->details[0]->nominee_Name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Relationship with nominee</label>
                            <input type="text" class="form-control" id="relation_with_nominee" name="relation_with_nominee" required placeholder="Enter Relationship with nominee" value="{{$user->details[0]->relation_with_nominee }}">
                        </div>


                        <h1>Sponser Details</h1>

                        <div style="border: 1px solid rgb(5 124 117); padding:15px">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Sponsor Code</label>
                                    <input type="sponser_code" class="form-control" id="sponser_code" value="{{ isset($sponsorDetails[0]->sponsor_code) ? $sponsorDetails[0]->sponsor_code : '' }}" placeholder="Enter Sponsor Code" readonly>               
                                                
                                    
                                </div> 
                                
                            </div>
                            <div class="row" id="spDiv" >
                                <div class="form-group col-md-6">
                                    <label for="spName">Sponsor Name</label>
                                    <input type="text" class="form-control" id="spName" value="{{ isset($sponsorDetails[0]->associate_name) ? $sponsorDetails[0]->associate_name : '' }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="spRank">Sponsor Rank</label>
                                    <input type="text" class="form-control" id="spRank" value="{{ isset($sponsorDetails[0]->rank_name) ? $sponsorDetails[0]->rank_name : '' }}" readonly>
                                </div>

                            </div>
                        </div> 
                        <br>

                        <h1>Bank Details:</h1>
                        <div class="form-group">
                            <label for="rank">A/c Holder Name</label>
                            <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" required placeholder="Enter A/c Holder Name" value="{{$user->details[0]->account_holder_name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" required placeholder="Enter Bank Name" value="{{$user->details[0]->bank_name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">Branch Name</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required placeholder="Enter Branch Name" value="{{$user->details[0]->branch_name }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">A/c No</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" required placeholder="Enter A/c No" value="{{$user->details[0]->account_number }}">
                        </div>
                        <div class="form-group">
                            <label for="rank">IFS Code</label>
                            <input type="text" class="form-control" id="ifc_code" name="ifc_code" required placeholder="Enter IFS Code" value="{{$user->details[0]->ifc_code }}">
                        </div>
                       

                        
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <!-- /.card-body -->

                        <div class="card-footer mt-2">
                        @if($user->is_edit == 0)<button type="submit" class="btn btn-primary">Submit</button>@endif
                        </div>
                        </form>
                        <br><br><br>
                        <h1>Change Password</h1>
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
<script>
function getCity(stateCode){
    var cityId = $("#cityId").val();
    //alert(cityId);
    var url="{{ URL::to('') }}"+"/get-cities";
    var postForm = { //Fetch form data
            'state_code'     : stateCode,
            'cityId' : cityId
            
        };
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url ,                
                data: postForm,
                datatype: 'JSON',
                success: (response) => {
                  console.log(response);
                  if(response!='0'){
                    $("#city_name").empty();
                  $("#city_name").append(response);                  

                  }else{
                    
                  }
                    
                },
                error: function(response){
                    
                }
           });

    }
    
    </script>
@endsection


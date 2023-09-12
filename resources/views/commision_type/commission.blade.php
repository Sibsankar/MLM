@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-left: 200px">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

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
                            
                     
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <!-- /.card-body -->

                        <div class="card-footer mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
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


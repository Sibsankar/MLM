@extends('general.layouts.app_general')

@section('content') 

  <!-- Main Sidebar Container -->
  
  
  <!-- Content Wrapper. Contains page content -->
  <div >
    <!-- Content Header (Page header) -->
    <div >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
            {{-- <h1 class="m-0">Joining Form</h1> --}}
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="padding-right: 200px; padding-left: 200px;">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       <div class="mb-2 text-center">
        <img src="{{ url('/')}}/assets/dist/img/dva.jpeg" height="80" width="200" alt="">
        <a href="{{ route('login') }}" class="btn btn-xl btn-success font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
        
       </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row ml-4 mr-4">

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Joining Form</h3>
              </div>
              
              @if(session('successmessage'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success_msgo">
                    {{session('successmessage')}}
                </div>
              @endif
              @if(count($errors))
                  @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error_msgo">
                      {{$error}}
                  </div>
                  @endforeach
              @endif
              <div class="" id="success_msg"></div>
              <div class="" id="error_msg"></div> 
              <!-- /.card-header -->
              @if(session('temppassword'))
                <input type="hidden" id="phone_no" value="{{session('temppassword')}}"/>
                <div class="mt-2 pl-3 text-left" id="resend_sec">
                  <p id="reset_timer">Resend Password in - <span id="timer"></span></p>
                  <button type="button" id="resend_otp" class="btn btn-info" onclick="resend()">Resend Password Now</button>
                </div>
              @endif
              <!-- form start -->
              <form method="POST" action="{{ route('addUser') }}" enctype='multipart/form-data'>
                @csrf
                <div class="card-body">
<input type="hidden" id="referred_by" name="referred_by" value="">
                <div style="border: 1px solid rgb(5 124 117); padding:15px">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Sponsor Code</label>
                      <input type="sponser_code" class="form-control" id="sponser_code" placeholder="Enter Sponsor Code">               
                         <p id="jErr" style="color: red"></p>           
                      <button type="button" class="btn btn-xs btn-success" onclick="getSponsorDetails()">Search</button> 
                    </div> 

                  </div>
                  <div class="row" id="spDiv" >
                    <div class="form-group col-md-6">
                      <label for="spName">Sponsor Name</label>
                      <input type="text" class="form-control" id="spName" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="spRank">Sponsor Rank</label>
                      <input type="text" class="form-control" id="spRank" readonly>
                    </div>

                    </div>
                </div>  
                   
                  
                  
                  <div class="form-group">
                    <label for="associate_name">Name of Associate</label>
                    <input type="text" class="form-control" name="associate_name" required id="associate_name" placeholder="Enter Name of Associate">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Date of Birth:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="dob" required data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Select Rank</label>
                    <select id="rank" name="rank" class="form-control select2" style="width: 100%;">
                      <option selected="selected">Select Rank</option>
                      @foreach($rankData as $ranks)
                      <option value="{{$ranks->id}}" >{{$ranks->rank_name}}</option>
                      @endforeach
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="rank">Aadhar No</label>
                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" required placeholder="Enter Aadhar No">
                  </div>
                  <!-- <div class="form-group">
                    <label for="rank">PAN No</label>
                    <input type="text" class="form-control" id="pan_no" name="pan_no" required placeholder="Enter PAN No">
                  </div> -->
                  <div class="form-group">
                    <label for="rank">Phone No</label>
                    <input type="text" class="form-control phone" id="phone_no" maxlength="10" name="phone_no" required placeholder="Enter Phone No" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputFile">Rank</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> --}}
                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            

          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  // -----------------timer ------------------------------- 
  setTimeout(function() {
    $('#success_msgo').hide();
    $('#error_msgo').hide();
    // $('#success_msg').hide();
    // $('#error_msg').hide();
  }, 30000);
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

  function resend() {
      $('#success_msgo').hide();
      $('#error_msgo').hide();
      // alert('resend otp');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          /* the route pointing to the post function */
          url: "{{ route('resend_reg_otp') }}",
          type: 'POST',
          data: {_token: CSRF_TOKEN, phone_no:$("#phone_no").val()},
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
  // timer end --------------------
  function phoneMask(e){
	var s=e.val();
	var s=s.replace(/[_\W]+/g,'');
	var n=s.length;
	if(n<11){var m='(00) 0000-00000';}else{var m='(00) 00000-00000';}
	$(e).mask(m);
}

// Type
$('body').on('keyup','.phone',function(){	
	phoneMask($(this));
});

// On load
$('.phone').keyup();




  function getSponsorDetails(){
    var spCode = $('#sponser_code').val();
    if(spCode==""){
      $("#jErr").text('please enter sponsor code to get your sponsor details');
      return false;
    }else{
      $("#jErr").text('');
    }
    var postForm = { //Fetch form data
            'spcode'     : spCode 
            
        };
      var url="{{ URL::to('') }}"+"/get-sponser-details";

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
                  
                  if(response!='0'){
                    
                    $("#spName").val(response.associate_name);
                    $("#spRank").val(response.rank_name);
                    $("#referred_by").val(response.user_id);
                    var postForm2 = { 
                    'rank_id'     : response.rank 

                    };
                    var url2="{{ URL::to('') }}"+"/get-rank-details";
              $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url2 ,                
                data: postForm2,
                datatype: 'JSON',
                success: (response) => {
                  console.log(response);
                  if(response!='0'){
                   $("#rank").empty();
                    $("#rank").append(response);                  

                  }else{
                    
                  }
                    
                },
                error: function(response){
                    
                }
           });

                  }else{
                    
                  }
                    
                },
                error: function(response){
                    
                }
           });
    
  }
</script>
@endsection




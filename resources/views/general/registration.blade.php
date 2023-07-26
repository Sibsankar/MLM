


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
              <!-- /.card-header -->
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
                    <label for="rank">Rank</label>
                    <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter Rank">
                  </div>
                  <div class="form-group">
                    <label for="rank">Aadhar No</label>
                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" required placeholder="Enter Aadhar No">
                  </div>
                  <div class="form-group">
                    <label for="rank">Phone No</label>
                    <input type="text" class="form-control" id="phone_no" name="phone_no" required placeholder="Enter Phone No">
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
  function getSponsorDetails(){
    var spCode = $('#sponser_code').val();
    var postForm = { //Fetch form data
            'spcode'     : spCode 
            
        };
      var url="{{ URL::to('') }}"+"/get-sponser-details";
//alert(url);
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
                    alert(response.associate_name);
                    $("#spName").val(response.associate_name);
                    $("#spRank").val(response.rank);
                    $("#referred_by").val(response.user_id);

                  }else{
                    
                  }
                    //alert('Form submitted successfully',response);
                    //location.reload();
                },
                error: function(response){
                    
                }
           });
    alert(spCode);
  }
  
</script>
@endsection




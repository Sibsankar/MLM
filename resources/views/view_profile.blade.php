@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Associate Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Associate Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if(!empty($associate->image)){?>
                  <img style="height: 100px; width:100px;" class="profile-user-img img-fluid img-circle"
                       src="{{ url('/')}}/images/{{ $associate->image }}"
                       alt="User profile picture"><?php }else{?>
                        
                        <img style="height: 100px; width:100px;" class="profile-user-img img-fluid img-circle"
                       src="{{ url('/')}}/images/no-image.png"
                       alt="User profile picture">
                        <?php }?>
                </div>

                <h3 class="profile-username text-center">{{ $associate->associate_name }}</h3>

                <p class="text-muted text-center">{{ $associate->rank_name }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>My Associates</b> <a class="float-right">N/A</a>
                  </li>
                  <li class="list-group-item">
                    <b>Earnings</b> <a class="float-right">N/A</a>
                  </li>
                  {{-- <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> --}}
                </ul>

                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Associate Code</strong>

                <p class="text-muted">
                  {{ $associate->sponsor_code }}
                </p>

                <hr>

                <strong><i class="fas fa-calendar mr-1"></i> DOB</strong>

                <p class="text-muted">{{ $associate->dob }}</p>

                <hr>
                <strong><i class="fas fa-user mr-1"></i> Gender</strong>

                <p class="text-muted">{{ $associate->gender }}</p>

                <hr>
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                <p class="text-muted">{{ $associate->email }}</p>

                <hr>
                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                <p class="text-muted">+91 - {{ $associate->phone_no }}</p>

                <hr>

                {{-- <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong> --}}

                {{-- <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p> --}}

                <hr>

                {{-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Nominee Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Sponser Details</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block row">
                        <label class="col-2">Father's /Husband's Name</label>
                        <div class="col-10">{{$user->details[0]->guardians_name }}</div>
                        <label class="col-2">Date of Birth</label>
                        <div class="col-10">{{date('d-m-Y', strtotime($user->details[0]->dob)) }}</div>
                        <label class="col-2">Address Line 1</label>
                        <div class="col-10">{{$user->details[0]->address_line1 }}</div>
                        <label class="col-2">Address Line 2</label>
                        <div class="col-10">{{$user->details[0]->address_line2 }}</div>
                        <label class="col-2">Country</label>
                        <div class="col-10">{{$user->details[0]->country_name }}</div>
                        <label class="col-2">State</label>
                        <div class="col-10">{{$user->details[0]->state_name }}</div>
                        <label class="col-2">City</label>
                        <div class="col-10">{{$user->details[0]->city_name }}</div> 
                        <label class="col-2">District</label>
                        <div class="col-10">{{$user->details[0]->district }}</div> 
                        <label class="col-2">Pincode</label>
                        <div class="col-10">{{$user->details[0]->pin }}</div>  
                      </div>
                      <!-- /.user-block -->
                      
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post">
                      <div class="user-block row">
                        <label class="col-2">Nominee Name</label>
                        <div class="col-10">{{$user->details[0]->nominee_Name }}</div>
                        <label class="col-2">Relationship with nominee</label>
                        <div class="col-10">{{$user->details[0]->relation_with_nominee }}</div> 
                      </div>
                      <!-- /.user-block -->
                      
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <div class="post">
                      <div class="user-block row">
                        <label class="col-2">Sponsor Code</label>
                        <div class="col-10">{{ isset($sponsorDetails[0]->sponsor_code) ? $sponsorDetails[0]->sponsor_code : '' }}</div>
                        <label class="col-2">Sponsor Name</label>
                        <div class="col-10">{{ isset($sponsorDetails[0]->associate_name) ? $sponsorDetails[0]->associate_name : '' }}</div> 
                        <label class="col-2">Sponsor Rank</label>
                        <div class="col-10">{{ isset($sponsorDetails[0]->rank_name) ? $sponsorDetails[0]->rank_name : '' }}</div> 
                      </div>
                      <!-- /.user-block -->
                      
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

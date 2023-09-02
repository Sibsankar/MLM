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
                    <h3 class="card-title">Import Users</h3>
                </div>
              
                @if(session('successmessage'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('successmessage')}}
                </div>
                @endif
                @if(session('temppassword'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('temppassword')}}
                </div>
                @endif
                @if(count($errors))
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$error}}
                    </div>
                    @endforeach
                @endif
                <!-- /.card-header -->
                <!-- form start -->
                <div class="p-4">
                    <h3>Excel/CSV file:</h3>
                    <form action="{{ route('import') }}" method="POST" name="importform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File:</label>
                            <input id="file" type="file" name="file" class="form-control">
                        </div>
                        <button class="btn btn-success">Import File</button>
                    </form>
                </div>
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


@endsection





<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="max-height:100vh;">
  <!-- Brand Logo -->
  <a href="{{ url('/')}}" class="brand-link">
   <img src="{{ url('/')}}/images/applogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> 
    {{-- <span class="brand-text font-weight-light">MLM</span> --}}
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php 
        $userDetails = DB::table('user_details')->where('user_id', Auth::user()->id)->first();
       if(!empty($userDetails->image)){
        $image = $userDetails->image;
       }else{
        $image = 'no-image.png';
       }
        ?>
        <img src="{{ url('/')}}/images/{{ $image }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        @if(Auth::user()->pwd_status == 1)
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <p>Edit Profile</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('viewProfile',['id'=>Auth::user()->id]) }}" class="nav-link">
            <p>View Profile</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('my-associate') }}" class="nav-link">
            <p>My Associates</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('collection_list') }}" class="nav-link">
            <p>My Collections</p>
          </a>
        </li>
        @if(\Auth::user()->type == 'admin')
        <li class="nav-item">
          <a href="{{ route('addCommissionCategory') }}" class="nav-link">
            <p>Commission Category</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('addCommissionType') }}" class="nav-link">
            <p>Commission Type</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('rank_list') }}" class="nav-link">
            <p>Rank Config List</p>
          </a>
        </li>
        @endif
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
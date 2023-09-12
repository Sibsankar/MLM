<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="max-height:100vh;">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">MLM</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url('/')}}/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
        @if(\Auth::user()->type == 'admin')
        <li class="nav-item">
          <a href="{{ route('addCommissionCategory') }}" class="nav-link">
            <p>Commission Category</p>
          </a>
        </li>
        @endif
        @if(\Auth::user()->type == 'admin')
        <li class="nav-item">
          <a href="{{ route('addCommissionType') }}" class="nav-link">
            <p>Commission Type</p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
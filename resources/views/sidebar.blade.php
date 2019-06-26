  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
        <!-- <li><a href="/voting"><i class="fa fa-link"></i> <span>Votings</span></a></li>
        <li><a href="/question"><i class="fa fa-link"></i> <span>Questions</span></a></li>
        <li><a href="/option"><i class="fa fa-link"></i> <span>Options</span></a></li> -->

        <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
        <li class="treeview">
          <a href="/voting"><i class="fa fa-link"></i> <span>Votings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/voting">All Votings</a></li>
            <li><a href="/voting/add">New Voting</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="/question"><i class="fa fa-link"></i> <span>Questions</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/question">All Question</a></li>
            <li><a href="/question/add">New Question</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="/option"><i class="fa fa-link"></i> <span>Options</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/option">All Options</a></li>
            <li><a href="/option/add">New Option</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
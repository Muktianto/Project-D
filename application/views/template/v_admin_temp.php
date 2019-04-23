
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Template</title>
  <?php 
  $stylesheet='<link rel="stylesheet" href="';
  $script='<script src="';

  $mod_f='assets/admin/modules/';
  $css_f='assets/admin/css/';
  $js_f='assets/admin/js/';

  //  ------------------  GENERAL  ------------------  
  // General CSS Files
  echo $stylesheet.base_url($mod_f.'bootstrap/css/bootstrap.min.css').'">';
  echo $stylesheet.base_url($css_f.'fontawesome_v5.8.1.css').'">';
  // Template CSS
  echo $stylesheet.base_url($css_f.'style.css').'">';
  echo $stylesheet.base_url($css_f.'components.css').'">';
  // DataTable
  echo $stylesheet.base_url($mod_f.'datatables/dataTables.bootstrap4.min.css').'">';
  echo $stylesheet.base_url($mod_f.'datatables/datatables.min.css').'">';
  echo $stylesheet.base_url($mod_f.'datatables/select.bootstrap4.min.css').'">';
  // Template CSS
  echo $stylesheet.base_url($mod_f.'summernote/dist/summernote-bs4.css').'">';
  echo $stylesheet.base_url($mod_f.'selectric/public/selectric.css').'">';
  echo $stylesheet.base_url($mod_f.'prism/prism.css').'">';
  echo $stylesheet.base_url($mod_f.'select2/select2.min.css').'">';
  // Toast
  echo $stylesheet.base_url($mod_f.'izitoast/iziToast.min.css').'">';

  //  ------------------  OPTIONAL  ------------------  
  if(!empty($ext)){
    if(in_array('advance_input', $ext)){
      echo $stylesheet.base_url($mod_f.'bootstrap-tagsinput/bootstrap-tagsinput.css').'">';
      echo $stylesheet.base_url($mod_f.'bootstrap-timepicker/bootstrap-timepicker.min.css').'">';
      echo $stylesheet.base_url($mod_f.'bootstrap-daterangepicker/daterangepicker.css').'">';
      echo $stylesheet.base_url($mod_f.'bootstrap-colorpicker/bootstrap-colorpicker.min.css').'">';
    }
    if(in_array('ionicon', $ext)){
      echo $stylesheet.base_url($mod_f.'ionicons/ionicons.min.css').'">';
    }
    if(in_array('image', $ext)){
      echo $stylesheet.base_url($mod_f.'owlcarousel2/dist/owl.theme.default.min.css').'">';
      echo $stylesheet.base_url($mod_f.'owlcarousel2/dist/owl.carousel.min.css').'">';
      echo $stylesheet.base_url($mod_f.'chocolat/dist/css/chocolat.css').'">';
    }
    if(in_array('map', $ext)){
      echo $stylesheet.base_url($mod_f.'jqvmap/dist/jqvmap.min.css').'">';
      echo $stylesheet.base_url($mod_f.'flag-icon-css/css/flag-icon.min.css').'">';
    }
    if(in_array('social', $ext)){
      echo $stylesheet.base_url($mod_f.'bootstrap-social/bootstrap-social.css').'">';
    }
    if(in_array('weather', $ext)){
      echo $stylesheet.base_url($mod_f.'weathericons/css/weather-icons.min.css').'">';
      echo $stylesheet.base_url($mod_f.'weathericons/css/weather-icons-wind.min.css').'">';
    }
    if(in_array('multiupload', $ext)){
      echo $stylesheet.base_url($mod_f.'dropzone/dropzone.css').'">';
    }
    if(in_array('code', $ext)){
      echo $stylesheet.base_url($mod_f.'codemirror/codemirror.css').'">';
      echo $stylesheet.base_url($mod_f.'codemirror/duotone-dark.css').'">';
    }
    if(in_array('calendar', $ext)){
      echo $stylesheet.base_url($mod_f.'fullcalendar/fullcalendar.min.css').'">';
    }
  }
  ?>

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-2">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">

                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-3.png'); ?>" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-1.png'); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
              </ul>
            </li>
            <li class="menu-header">Starter</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

            <li class="nav-item dropdown active">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="modules-calendar.html">Calendar</a></li>
                <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
                <li class="active"><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
                <li><a class="nav-link" href="modules-flag.html">Flag</a></li>
              </ul>
            </li>
            <li class="menu-header">Pages</li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
              <ul class="dropdown-menu">
                <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                <li><a href="auth-login.html">Login</a></li>
                <li><a class="beep beep-sidebar" href="auth-login-2.html">Login 2</a></li>
                <li><a href="auth-register.html">Register</a></li>
                <li><a href="auth-reset-password.html">Reset Password</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>DataTables</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Modules</a></div>
              <div class="breadcrumb-item">DataTables</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Advanced Table</h4>
                    <a href="#" class="btn btn-icon icon-left btn-info"><i class="fa fa-plus" style="font-size: smaller;"></i> Add</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-2">
                        <thead>
                          <tr>
                            <th class="text-center">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                            </th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Members</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-5.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                            </td>
                            <td>2018-01-20</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                <div class="progress-bar" data-width="0"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-1.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-3.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-4.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                            </td>
                            <td>2018-04-10</td>
                            <td><div class="badge badge-info">Todo</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                <div class="progress-bar bg-warning" data-width="70%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-1.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-2.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                            </td>
                            <td>2018-01-29</td>
                            <td><div class="badge badge-warning">In Progress</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                                <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-2.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-5.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-4.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                              <img alt="image" src="<?php echo base_url('assets/admin/img/avatar/avatar-1.png'); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                            </td>
                            <td>2018-01-16</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          &copy; 2019 <div class="bullet"></div> Stisla 2.3.0
        </div>
        <div class="footer-right">
          <?php  
          if(!empty($start)){
            echo 'Elapsed time '.number_format((microtime(true) - $start),4).'(s).';
          }
          ?>
        </div>
      </footer>
    </div>
  </div>

  <?php 
  // ------------  General JS Scripts ------------
  echo $script.base_url($mod_f.'jquery-3.3.1.min.js').'"></script>';
  echo $script.base_url($mod_f.'popper.js').'"></script>';
  echo $script.base_url($mod_f.'tooltip.js').'"></script>';
  echo $script.base_url($mod_f.'bootstrap/js/bootstrap.min.js').'"></script>';
  echo $script.base_url($mod_f.'nicescroll/jquery.nicescroll.min.js').'"></script>';
  echo $script.base_url($mod_f.'moment.min.js').'"></script>';
  echo $script.base_url($js_f.'stisla.js').'"></script>';

  // ------------  JS Libraies ------------
  echo $script.base_url($mod_f.'datatables/dataTables.bootstrap4.min.js').'"></script>';
  echo $script.base_url($mod_f.'datatables/datatables.min.js').'"></script>';
  echo $script.base_url($mod_f.'datatables/dataTables.select.min.js').'"></script>';
  echo $script.base_url($mod_f.'datatables/jquery-ui/jquery-ui.min.js').'"></script>';
  echo $script.base_url($js_f.'page/modules-datatables.js').'"></script>';

  // ------------  JS Libraies ------------
  echo $script.base_url($js_f.'scripts.js').'"></script>';
  echo $script.base_url($js_f.'custom.js').'"></script>';

  



  ?>

</body>
</html>

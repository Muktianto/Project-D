
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo !empty($title) ? $title : 'Untitled' ?></title>
  <link rel="icon" href="<?php echo base_url('assets/admin/img/favicon/' . rand(1, 113) . '.png') ?>" >
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
       <!-- LOAD NAVBAR -->
       <?php $this->load->view('template/v_navbar'); ?>
     </nav>

     <div class="main-sidebar sidebar-style-2">
      <!-- LOAD SIDEBAR -->
      <?php $this->load->view('template/v_sidebar'); ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <section class="section">
        <!-- LOAD CONTENT -->
        <?php 
        echo $content;
        // $this->load->view('template/v_content'); 
        ?>
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

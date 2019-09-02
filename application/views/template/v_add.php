<div class="section-header">
  <h1 class="section-title">ADD</h1>&nbsp&nbsp&nbsp
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Modules</a></div>
    <div class="breadcrumb-item">DataTables</div>
  </div>
</div>

<div class="section-body">
  <!-- <form class="needs-validation" novalidate=""> -->
  <form action="<?php base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
    <div class="row">

      <div class="col-12 col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Group Name 1</h4>
          </div>
          <div class="card-body">

            <div class="form-group">
              <label>Your Name CCCCC</label>
              <input type="textarea" class="form-control">
              <div class="invalid-feedback">
                What's your name?
              </div>
            </div>

            <div class="form-group mb-0">
              <label>Message</label>
              <textarea class="form-control"></textarea>
              <div class="invalid-feedback">
                What do you wanna say?
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="col-12 col-md-6">
        <div class="card card-primary">
          <!--  <div class="card-header">
            <h4>Group Name 2</h4>
          </div> -->
          <div class="card-body">
            <div class="form-group">
              <label>Your Name</label>
              <input type="text" class="form-control" required="">
              <div class="invalid-feedback">
                What's your name?
              </div>
            </div>
            <div class="form-group mb-0">
              <label>Message</label>
              <textarea class="form-control" required=""></textarea>
              <div class="invalid-feedback">
                What do you wanna say?
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Group Name</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- --------------------- -->
              <div class="col-12 col-md-6">
                <!-- --------------------- -->
                <div class="form-group">
                  <label>Your Name</label>
                  <input type="text" class="form-control" required="">
                  <div class="invalid-feedback">
                    What's your name?
                  </div>
                </div>
                <div class="form-group">
                  <label>Your Name</label>
                  <input type="text" class="form-control" required="">
                  <div class="invalid-feedback">
                    What's your name?
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control" required=""></textarea>
                  <div class="invalid-feedback">
                    What do you wanna say?
                  </div>
                </div>
                <div class="form-group">
                  <label>Your Name</label>
                  <input type="text" class="form-control" required="">
                  <div class="invalid-feedback">
                    What's your name?
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer text-right">
            <a href="'.  site_url($this->module_page.'/create/').'" class="btn btn-icon icon-left btn-secondary"><i class="fa fa-chevron-left"></i> Cancel</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            <?php
            // echo anchor('admin/module', 'Cancel', 'class="btn btn-default"');
            // echo form_close();
            ?>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>
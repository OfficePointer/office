<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->   
    <!-- Main content -->
    <section class="content">
    <ul class="nav nav-pills nav-wizard">
        <li class="active"><a data-toggle="tab">Select Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a>Customize Template</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a>Select Recipients</a><div class="nav-arrow"></div></li>
        <li><div class="nav-wedge"></div><a>Configure Campaign</a><div class="nav-arrow"></li>
        <li><div class="nav-wedge"></div><a>Summary</a></li>
    </ul>
      <h3>Select E-Mail Template</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="box-data">
        <?php foreach ($data as $key) { ?>
          <a href="<?php echo base_url("marketing/customize_template/".$key['id']);?>">
          <div class="box-data-detail">
            <div class="box-inside">
              <div class="box-inside-side">
                <div>Template Name : <?php echo $key['name'];?></div>
                <div>Author : <?php echo $this->general->get_user($key['id_user']);?></div>
                <div class="detail-box-inside-side"><?php echo $key['description'];?></div>
                <div><a target="_blank" href="<?php echo base_url("marketing/email_templates_view/".$key['id']);?>">Preview</a></div>
              </div>
            </div>
          </div>
          </a>
        <?php } ?>
        </div>
      </div>
    </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Beban Error Sistem
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <div class="alert alert-success">
          <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('operational/upload_form');?>">
            <input type="file" name="form" class="form-control"/>
            <hr>
            <button class="btn btn-primary pull-right">Upload</button>
            <br>
            <br>
          </form>
        </div>
        <?php echo $data;?>
        
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
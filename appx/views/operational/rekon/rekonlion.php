<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekon Tiket Lion Air
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?php echo base_url("operational/processrekonlion");?>" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>CSV Statement Lion</td>
                    <td><input required type="file" name="csvlion"></td>
                </tr>
                <tr>
                    <td>XLS FIT Report Pointer</td>
                    <td><input required type="file" name="csvpointer"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn btn-primary" type="submit" name="simpan">Submit</button></td>
                </tr>
            </table>
            </form>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
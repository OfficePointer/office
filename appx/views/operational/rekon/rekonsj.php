<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekon Tiket Sriwijaya Air
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form method="POST" action="<?php echo base_url("operational/processrekonsj");?>" enctype="multipart/form-data">
          <table class="table">
              <tr>
                  <td>XLS Incentive Sriwijaya Air</td>
                  <td><input required data-transform="input-control" type="file" name="csvsj"></td>
              </tr>
              <tr>
                  <td>XLS FIT Report Pointer</td>
                <td><input required data-transform="input-control" type="file" name="csvpointer"></td>
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>Void Done<br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>DateTime</th>
            <th>Info</th>
            <th>Void Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($actionsys as $key) {
        ?>
          <tr>
            <td><?php echo $key['created_at'];?></td>
            <td><?php echo $key['info'];?></td>
            <td><?php echo $key['est_budget'];?></td>
            <td><a onclick="openrequest('<?php echo $key['id'];?>','void')">Open</a></td>

          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>

      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>Rebook Pending<br>
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
            <th>Brand Name</th>
            <th>Kode Booking</th>
            <th>Airline</th>
            <th>Est Budget</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($actionsys as $key) {
        ?>
          <tr>
            <td><?php echo $key['created_at'];?></td>
            <td><?php echo $this->general->get_member($key['id_mitra'],1);?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $this->general->get_vendor($key['vendor']);?></td>
            <td><?php echo number_format($key['est_budget'],2,",",".");?></td>
            <td><a onclick="openrequest('<?php echo $key['id'];?>','rebook')">Open</a></td>
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

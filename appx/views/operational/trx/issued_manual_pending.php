<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>Issued Manual Pending<br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables_asc">
        <thead>
          <tr>
            <th>Brand Name</th>
            <th>Kode Booking</th>
            <th>Airline</th>
            <th>Memberpaid</th>
            <th>NTA</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach($actionsys as $key){
        ?>
          <tr>
            <td><?php echo $this->general->get_member($key['id_mitra'],1);?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $this->general->get_vendor($key['vendor']);?></td>
            <td><?php echo number_format($key['memberpaid'],2,".",",");?></td>
            <td><?php echo number_format($key['nta'],2,".",",");?></td>
            <td><a onclick="openrequest('<?php echo $key['id'];?>','issued')">Open</a></td>
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

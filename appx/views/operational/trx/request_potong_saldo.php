<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br><center>Request Potong Saldo</center><br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID Ticket</th>
            <th>ID Infosys</th>
            <th>Kode Booking</th>
            <th>Est Budget</th>
            <th>Brand Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($actionsys as $key) {
        ?>
          <tr>
            <td><?php echo $key['id_ticket'];?></td>
            <td><?php echo $key['id_infosys'];?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $key['est_budget'];?></td>
            <td><?php echo $key['brand_name'];?></td>
            <td><a href=""> link </a> </td>
            
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <br>Request Potong Saldo<br>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/save_request_potong_saldo");?>">

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID Ticket</th>
            <th>Info</th>
            <th>Kode Booking</th>
            <th>Airline</th>
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
            <td><?php echo $this->general->get_infosys_by_idflowsys($key['id_flowsys']);?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $this->general->get_vendor($key['vendor']);?></td>
            <td><?php echo $key['est_budget'];?></td>
            <td><?php echo $this->general->get_member($key['id_mitra']);?></td>
            <td><a onclick="openrequest('<?php echo $key['id'];?>')">Open</a></td>
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
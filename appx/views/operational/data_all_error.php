<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Data All Error
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kasus</th>
            <th title="Kode Booking">KB</th>
            <th title="Error DateTime">Error DT</th>
            <th title="Solve Note">Solve NT</th>
            <th title="Solve DateTime">Solve DT</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($error as $key) {
        ?>
          <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['kasus'];?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $key['created_at'];?></td>
            <td><?php echo $key['solve_note'];?></td>
            <td><?php echo $key['updated_at'];?></td>
            <td><a onclick="openformdetail(<?php echo $key['id_mitra'];?>)" data-toggle="tooltip" data-placement="top" title="Detail Mitra">DTM</a> | <a data-toggle="tooltip" data-placement="left" title="Brand Name : <?php echo $this->general->get_member($key['id_mitra']);?> | Status : <?php echo $key['status'];?> | Error DateTime : <?php echo $key['created_at'];?> | Solve DateTime : <?php echo $key['updated_at'];?> | Solve By : <?php echo $this->general->get_user($key['updated_by']);?>">DTE</a></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
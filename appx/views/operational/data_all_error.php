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
            <th>Brand Name</th>
            <th>Kode Booking</th>
            <th>Status</th>
            <th>Error DateTime</th>
            <th>Solve By</th>
            <th>Solve Note</th>
            <th>Solve DateTime</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($error as $key) {
        ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $key['kasus'];?></td>
            <td><?php echo $this->general->get_member($key['id_mitra']);?></td>
            <td><?php echo $key['kode_booking'];?></td>
            <td><?php echo $key['status'];?></td>
            <td><?php echo $key['created_at'];?></td>
            <td><?php echo $this->general->get_user($key['updated_by']);?></td>
            <td><?php echo $key['solve_note'];?></td>
            <td><?php echo $key['updated_at'];?></td>
          </tr>
        <?php
        $i++;
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
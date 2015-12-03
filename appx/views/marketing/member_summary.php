<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member Summary
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>Date Join</th>
            <th>Brand Name</th>
            <th>Trx</th>
            <th>Age</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($membersummary as $key) {
        ?>
        <tr>
          <td><?php echo $key['date_join'];?></td>
          <td><?php echo $key['brand_name'];?></td>
          <td><?php echo $key['jumlah'];?></td>
          <td><?php echo $key['umur'];?></td>
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
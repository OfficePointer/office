<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <span class="pull-right"><a href="" class="btn btn-success">Refresh</a></span>
      <h1>
        Funnyname List
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12" id="kolam_funnyname">
      <table class="table table-bordered table-striped for_datatables_asc">
        <thead>
          <tr>
            <th>Brand Name</th>
            <th>Prefix</th>
            <th>Jumlah Kode</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($funnyname as $key) {
        ?>
          <tr>
            <td><a onclick="openformdetail(<?php echo $key['id_mitra'];?>)"><?php echo $key['brand_name'];?></a></td>
            <td><?php echo $key['prefix'];?></td>
            <td><?php echo $key['jumlah'];?></td>
            <td><a onclick="show_funnyname('<?php echo $key['link'];?>')">Click Here</a></td>
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
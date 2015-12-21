<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member Statistic
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <h2>Statistic Member per Type</h2>
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>Type</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($pertype as $key) {
        ?>
        <tr>
          <td><?php echo $key['type'];?></td>
          <td><?php echo $key['jumlah'];?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      <hr>

        <h2>Statistic Mitra &amp; SubMitra</h2>
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>Brand Name (Prefix)</th>
            <th>Jumlah Submitra</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($mitrasub as $key) {
        ?>
        <tr>
          <td><a onclick="openformdetail(<?php echo $key['id_mitra'];?>)"><?php echo $key['brand_name']." (".$key['prefix'].")";?></a></td>
          <td><?php echo $key['jumlah'];?></td>
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo ($this->uri->segment(3)=="new")?"New":"All";?> Member
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Pengguna</th>
            <th>URL</th>
            <th>IP</th>
            <th>Waktu</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($logdata as $key) {
        ?>
          <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $this->general->get_user($key['idpengguna']);?></td>
            <td><a target="_blank" href="<?php echo $key['url'];?>"><?php echo $key['url'];?></a></td>
            <td><?php echo $key['ip'];?></td>
            <td><?php echo $key['tanggal']." ".$key['jam'];?></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      <?php echo $paging;?>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
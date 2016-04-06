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
            <th>Pengguna</th>
            <th>Visit</th>
            <th>Last Visit</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $key) {
          $this->db->where('idpengguna',$key['idpengguna']);
          $this->db->where('tanggal',date("Y-m-d"));
          $this->db->order_by('id','desc');
          $this->db->limit(1);
          $a = $this->db->get('logdata')->row_array();
          ?>
          <tr>
            <td><?php echo $key['nama'];?></td>
            <td><?php echo $key['jumlah'];?></td>
            <td><?php echo (date("Y-m-d")==$a['tanggal']?"Today at ":date_format(date_create($a['tanggal']),"D, d M Y")." at ").$a['jam'];?></td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
        <hr>
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
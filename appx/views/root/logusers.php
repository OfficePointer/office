<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Log Users
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
            <th>Today Visit</th>
            <th>All Visit</th>
            <th>Last Visit</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $key) {
          $this->db->where('idpengguna',$key['idnya']);
          $this->db->order_by('id','desc');
          $this->db->limit(1);
          $a = $this->db->get('logdata')->row_array();
          ?>
          <tr>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['jumlah'];?></td>
            <td><?php echo $key['allvisit'];?></td>
            <td><?php echo empty($a)?"Never":((date("Y-m-d")==$a['tanggal']?"Today at ":date_format(date_create($a['tanggal']),"D, d M Y")." at ").$a['jam']);?></td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
      </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
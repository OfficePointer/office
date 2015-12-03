<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("operational/addkoran");?>">Add New</a></span>
      <h1>
        Koran Publisher
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($koran as $key) {
        ?>
          <tr>
            <td><?php echo $key['tanggal']." ".$key['jam'];?></td>
            <td><?php echo $key['judul'];?></td>
            <td>
              <a href="<?php echo base_url("operational/editkoran/".$key['id']);?>">Edit</a>
              <a href="<?php echo base_url("operational/deletekoran/".$key['id']);?>">Delete</a>
              <a href="<?php echo base_url("operational/kirim_surat/".$key['id']);?>">Send Mail</a>
            </td>
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
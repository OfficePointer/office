<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage User
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables_asc">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Divisi</th>
            <th>Jabatan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $key) {
        ?>
          <tr>
            <td><?php echo $key['name']." (".$key['email'].")";?></td>
            <td><?php echo $this->general->get_sys_div($key['id_division']);?></td>
            <td><?php echo $this->general->get_sys_lev($key['id_level']);?></td>
            <td><a href="<?php echo base_url("settings/user_edit/".$key['ID']);?>">Edit</a> <?php if($key['password']=="16d7a4fca7442dda3ad93c9a726597e4"){?>| <a href="<?php echo base_url("root/sendmail/".$key['ID']);?>">SendMail</a><?php } ?></td>
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
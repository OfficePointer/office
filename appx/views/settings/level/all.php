<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("settings/level_add");?>">Add Level</a></span>
      <h1>
      Manage Level
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
            <th>Division</th>
            <th>Parent</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($level as $key) {
        ?>
          <tr>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $this->general->get_sys_div($key['id_division']);?></td>
            <td><?php echo $this->general->get_sys_lev($key['id_level']);?></td>
            <td><a href="<?php echo base_url("settings/level_edit/".$key['id']);?>">Edit</a></td>
            <td><a href="<?php echo base_url("settings/level_delete/".$key['id']);?>">Delete</a></td>
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
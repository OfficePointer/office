<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("root/email_templates_add");?>">Add E-Mail Template</a></span>
      <h1>
      Manage E-Mail Templates
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
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($email as $key) {
        ?>
          <tr>
            <td><?php echo $key['judul'];?></td>
            <td><a href="<?php echo base_url("root/email_templates_edit/".$key['id']);?>">Edit</a></td>
            <td><a href="<?php echo base_url("root/email_templates_delete/".$key['id']);?>">Delete</a></td>
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
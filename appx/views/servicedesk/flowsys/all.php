<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("servicedesk/flowsys_add");?>">Add Infosys</a></span>
      <h1>
      Manage Flowsys
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables_asc">
        <thead>
          <tr>
            <th>Info</th>
            <th>Type</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($flow as $key) {
        ?>
          <tr>
            <td><?php echo $this->general->get_infosys($key['id_info']);?></td>
            <td><?php echo $key['type'];?></td>
            <td><?php echo $key['description'];?></td>
            <td><a href="<?php echo base_url("servicedesk/flowsys_delete/".$key['id']);?>">Delete</a></td>
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
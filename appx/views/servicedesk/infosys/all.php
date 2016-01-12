<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("servicedesk/infosys_add");?>">Add Infosys</a></span>
      <h1>
      Manage Infosys
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
            <th>Nama</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($info as $key) {
        ?>
          <tr>
            <td><?php echo $key['info'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><a href="<?php echo base_url("servicedesk/infosys_delete/".$key['id']);?>" onClick="return doconfirm();">Delete</a><script>
            function doconfirm()
            {
              job=confirm("Are you sure to delete this data?");
              if(job!=true)
              {
              return false;
              }
            }
              </script></td>
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
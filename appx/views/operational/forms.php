<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Forms
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped for_datatables">
        <thead>
          <tr>
            <th>Date Time</th>
            <th>Title</th>
            <th>Main Forms?</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($formdata as $key) {
        ?>
          <tr>
            <td><?php echo $key['create_at'];?></td>
            <td><?php echo $key['judul'];?></td>
            <td><?php echo ($key['utama']==1)?"yes":"no";?></td>
            <td><a href="<?php echo base_url('operational/editform/'.$key['id']);?>">Edit</a>
                <a href="<?php echo base_url('operational/deleteform/'.$key['id']);?>">Delete</a>
                <a href="<?php echo base_url('operational/form/'.$key['id']);?>">View</a></td>
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
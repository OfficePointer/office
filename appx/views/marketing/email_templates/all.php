<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">        
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/email_templates_add");?>">Add E-Mail Templates</a></span>
      <h1>
        E-Mail Templates
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Author</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $val => $key) {
        ?>
          <tr>
            <td><?php echo $val+1;?></td>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['description'];?></td>
            <td><?php echo $this->general->get_user($key['id_user']);?></td>
            <td><a target="_blank" href="<?php echo base_url('marketing/email_templates_view/'.$key['id']);?>">View Templates</a></td>
            <td><a href="<?php echo base_url('marketing/email_templates_edit/'.$key['id']);?>">Edit</a></td>
            <td><a onclick="return confirm('Are you sure to delete email template <?php echo $key['name'];?>')" href="<?php echo base_url('marketing/email_templates_delete/'.$key['id']);?>">Delete</a></td>
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
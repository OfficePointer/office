<div class="content-wrapper">
  <section class="content-header">        
  <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list_add");?>">Add Subscribers List</a></span>
    <h1>
      Subscribers List
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Subscribers</th>
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
              <td><?php echo $key['subscribers'];?> subscribers</td>
              <td><?php echo $this->general->get_user($key['id_user']);?></td>
              <td><a target="_blank" href="<?php echo base_url('marketing/subscribers_list_view/'.$key['id']);?>">View Subscribers</a></td>
              <td><a href="<?php echo base_url('marketing/subscribers_list_manage/'.$key['id']);?>">Manage</a></td>
              <td><a onclick="return confirm('Are you sure to delete recipient list <?php echo $key['name'];?>')" href="<?php echo base_url('marketing/subscribers_list_delete/'.$key['id']);?>">Delete</a></td>
            </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
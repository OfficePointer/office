<div class="content-wrapper">
  <section class="content-header">        
  <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/lookup_recipient_add");?>">Add Lookup Recipient</a></span>
    <h1>
      Lookup Recipient
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
          <th>Query</th>
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
          <td style="width:400px;"><?php echo $key['query'];?></td>
          <td><?php echo $this->general->get_user($key['id_user']);?></td>
          <td><a target="_blank" href="<?php echo base_url('marketing/lookup_recipient_view/'.$key['id']);?>">View Recipient</a></td>
          <td><a href="<?php echo base_url('marketing/lookup_recipient_edit/'.$key['id']);?>">Edit</a></td>
          <td><a onclick="return confirm('Are you sure to delete lookup recipient <?php echo $key['name'];?>')" href="<?php echo base_url('marketing/lookup_recipient_delete/'.$key['id']);?>">Delete</a></td>
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
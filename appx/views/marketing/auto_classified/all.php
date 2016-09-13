<div class="content-wrapper">
  <section class="content-header">        
  <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/auto_classified_member_add");?>">Add Auto Classified Member</a></span>
    <h1>
      Auto Classified Member
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Data</th>
              <th>Condition</th>
              <th>Value</th>
              <th>Author</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($data as $val => $key) {
          ?>
            <tr>
              <td><?php echo $val+1;?></td>
              <td><?php echo $key['data'];?></td>
              <td><?php echo $key['condition'];?></td>
              <td><?php echo $key['value'];?></td>
              <td><?php echo $this->general->get_user($key['id_user']);?></td>
              <td><a href="<?php echo base_url('marketing/auto_classified_member_edit/'.$key['id']);?>">Edit</a></td>
              <td><a onclick="return confirm('Are you sure to delete this data?');" href="<?php echo base_url('marketing/auto_classified_member_delete/'.$key['id']);?>">Delete</a></td>
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/subscribers_list");?>">All Subscribers List</a></span>
      <h1>
      Add Subscribers List
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/subscribers_list_save");?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" required name="name" placeholder="Name of Subscribers List">
        </div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Next</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
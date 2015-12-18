<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Edit Division
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("pengaturan/division_update");?>">
      	<div class="form-group">
      		<label>Name</label>
          <input type="hidden" class="form-control" name="id" value="<?php echo $division['id'];?>">
      		<input type="text" class="form-control" name="name" value="<?php echo $division['name'];?>">
      	</div>
      	<div class="form-group">
      		<label>Description</label>
      		<textarea class="form-control" required name="description" id="description"><?php echo $division['description'];?></textarea>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Update</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
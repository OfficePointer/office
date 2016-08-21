<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/email_templates");?>">All E-Mail Templates</a></span>

      <h1>
      Edit E-Mail Template
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/email_templates_update");?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" value="<?php echo $data['name'];?>" class="form-control" required name="name" placeholder="Name of Templates">
          <input type="hidden" value="<?php echo $data['id'];?>"required name="id" >
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text"  value="<?php echo $data['description'];?>" class="form-control" required name="description" placeholder="Short description about templates">
      	</div>
      	<div class="form-group">
      		<label>Content</label>
      		<textarea class="form-control notes" required name="content" id="notes"><?php echo $data['content'];?></textarea>
      <?php echo display_ckeditor($ckeditor); ?>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Submit</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
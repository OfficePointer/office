<script type="text/javascript">
  get_user_assign();
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Edit E-Mail Template
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-4">
      <label>Recipient</label>
      <div id="user_assign_id"></div>
      </div>
      <div class="col-md-8">
      <form method="POST" action="<?php echo base_url("root/email_templates_update");?>">
      	<div class="form-group">
      		<label>Name</label>
          <input type="hidden" class="form-control" name="id" value="<?php echo $email['id'];?>">
      		<input type="text" class="form-control" name="judul" value="<?php echo $email['judul'];?>">
          <input type="hidden" id="id_user" class="form-control" name="id_user">
      	</div>
      	<div class="form-group">
      		<label>Description</label>
      		<textarea class="form-control" required name="template" id="template"><?php echo $email['template'];?></textarea>
          <?php echo display_ckeditor($ckeditor); ?>
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

  <script type="text/javascript">
  setTimeout(function () {
  var id_user = "<?php echo $email['id_user'];?>";
  var split = id_user.split(",");
    for (data in split){
      $("#user_assign_id").jqxTree('checkItem', $("#"+split[data])[0], true);
    }
  },2000);
  </script>
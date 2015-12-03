<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Publish Koran
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("operational/koran_save");?>">
      	<div class="form-group">
      		<label>Judul</label>
      		<input type="text" class="form-control" name="judul">
      	</div>
      	<div class="form-group">
      		<label>Isi</label>
      		<textarea required name="notes" id="notes"></textarea>
			<?php echo display_ckeditor($ckeditor); ?>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Publish</button>
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
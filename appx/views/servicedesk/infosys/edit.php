<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Add Infosys
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("servicedesk/infosys_update");?>">
      <input class="form-control" type="hidden" required name="id" id="id" value="<?php echo $info['id'];?>">
        <div class="form-group">
          <label>Info</label>
          <select type="text" class="form-control" name="info">
            <option value="issued">Issued Manual</option>
            <option value="refund">Refund</option>
            <option value="rebook">Rebook</option>
            <option value="void">Void</option>
          </select>
        </div>
      	<div class="form-group">
      		<label>Title</label>
      		<input type="text" value="<?php echo $info['title']?>" class="form-control" name="title">
      	</div>
      	<div class="form-group">
      		<label>Description</label>
      		<textarea class="form-control" value="<?php echo $info['desc']?>" required name="desc" id="desc"></textarea>
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Edit Level
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("settings/level_update");?>">
      	<div class="form-group">
      		<label>Name</label>
          <input type="hidden" class="form-control" name="id" value="<?php echo $data['id'];?>">
      		<input type="text" class="form-control" name="name" value="<?php echo $data['name'];?>">
      	</div>
        <div class="form-group">
          <label>Division</label>
          <select type="text" class="form-control" name="id_division">
          <?php 
          foreach ($division as $key) {
            ?><option <?php echo (($data['id_division']==$key['id'])?"selected":"");?> value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option><?php
          }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label>Parent Level</label>
          <select type="text" class="form-control" name="id_level">
          <option value="0">This is parent</option>
          <?php 
          foreach ($level as $key) {
            ?><option <?php echo ($data['id_level']==$key['id'])?"selected":"";?> value="<?php echo $key['id'];?>"><?php echo $key['name']." - ".$this->general->get_sys_div_lev($key['id']);?></option><?php
          }
          ?>
          </select>
        </div>
      	<div class="form-group">
      		<label>Description</label>
      		<textarea class="form-control" required name="description" id="description"><?php echo $data['description'];?></textarea>
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
  <!-- /.content-wrapper -->
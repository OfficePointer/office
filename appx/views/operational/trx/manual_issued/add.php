<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      New Manual Issued
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-12">
      <form method="POST" action="">
      	<div class="form-group">
      		<label>Issued For</label>
          <select class="form-control" name="type_info">
            <?php foreach ($type_info as $key) {
              ?>
                <option value="<?php echo $key['id'];?>"><?php echo $key['info'];?></option>
              <?php
            }
            ?>
          </select>
      	</div>
      	<div class="form-group">
      		<label>Tanggal Issued</label> 
          <input autocomplete="off" type="text" class="form-control for_date" name="tgl_info">
      	</div>
        <label>Kode Booking</label> 
        <div class="input-group">
          <input autocomplete="off" type="text" class="form-control" id="kode_booking" name="kode_booking">
          <span onclick="lookupcode()" class="input-group-addon"><i class="fa fa-search"></i></span>
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
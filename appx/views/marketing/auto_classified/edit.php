<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
    <span class="pull-right"><a class="btn btn-success" href="<?php echo base_url("marketing/auto_classified_member");?>">All Auto Classified</a></span>
      <h1>
      Edit Auto Classified
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/auto_classified_member_update");?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
          <label>Data</label>
          <select type="text" class="form-control" required name="data">
            <option value="">Select Data</option>
            <option <?php echo $data=="tlm"?"selected":"";?> value="tlm">Transaction Last Month</option>
          </select>
        </div>
        <div class="form-group">
          <label>Operator</label>
          <select type="text" class="form-control" required name="condition">
            <option <?php echo $condition==">="?"selected":"";?> value=">=">>=</option>
            <option <?php echo $condition==">"?"selected":"";?> value=">">></option>
            <option <?php echo $condition=="="?"selected":"";?> value="=">=</option>
            <option <?php echo $condition=="<"?"selected":"";?> value="<"><</option>
            <option <?php echo $condition=="<="?"selected":"";?> value="<="><=</option>
          </select>        
        </div>
        <div class="form-group">
          <label>Condition Value</label>
          <input type="number" name="value" required class="form-control" value="<?php echo $value;?>">
        </div>
        <div class="form-group">
          <label>Set Classification</label>
          <select type="text" class="form-control" required name="set_classification_id">
            <?php foreach ($datax as $key) { ?>
            <option <?php echo $set_classification_id==$key['id']?"selected":"";?> value="<?php echo $key['id'];?>"><?php echo $key['klasifikasi'];?></option>
            <?php } ?>
          </select>        
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
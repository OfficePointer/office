<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">    
      <h1>
      Add Subscribers to "<?php echo $data['name'];?>" List
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <form method="POST" action="<?php echo base_url("marketing/subscribers_list_manage_save");?>">
        <div class="form-group">
        <input type="hidden" name="id_master" value="<?php echo $data['id'];?>">
          <label>Source</label>
          <select class="form-control" name="source" id="source">
            <option value="0">--Select--</option>
            <option value="1">Lookup Recipient</option>
            <option value="2">Member by Classification</option>
            <option value="3">Member by Type</option>
          </select>
        </div>
        <div class="form-group" id="source_1" style="display:none;">
          <label>Lookup Recipient</label>
          <select name="data_1" class="form-control">
            <?php foreach ($pre_lists as $key) { ?>
              <option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group" id="source_2" style="display:none;">
          <label>Member by Classification</label>
          <select name="data_2" class="form-control">
            <?php foreach ($classification as $key) { ?>
              <option value="<?php echo $key['id'];?>"><?php echo $key['klasifikasi'];?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group" id="source_3" style="display:none;">
          <label>Member by Type</label>
          <select name="data_3" class="form-control">
            <?php foreach ($type as $key) { ?>
              <option value="<?php echo $key['id_type'];?>"><?php echo $key['type'];?></option>
            <?php } ?>
          </select>
        </div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Save</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    $("#source").on('change',function() {
      var val = $("#source").val();
      
      for(var i=1;i<=3;i++){
        $("#source_"+i).fadeOut();
      }
      setTimeout(function() {
        $("#source_"+val).fadeIn();
      },500)
    });
  </script>
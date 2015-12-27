  
  <script type="text/javascript">
  get_user_assign();
  </script>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
      Edit Flowsys
      </h1>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-4">
      <label>User Assign</label>
      <div id="user_assign_id"></div>
      </div>
      <div class="col-md-8">
      <form method="POST" action="<?php echo base_url("servicedesk/flowsys_update");?>">
          <input class="form-control" type="hidden" required name="id" id="id" value="<?php echo $flow['id'];?>">
          <input class="form-control" type="hidden" required name="assign_user" id="id_user" value="<?php echo $flow['assign_user'];?>">
        <div class="form-group">
          <label>Info</label>
          <select type="text" class="form-control" name="id_info">
          <?php foreach ($info as $key) { ?>
            <option <?php echo ($flow['id_info']==$key['id'])?"selected":"";?> value="<?php echo $key['id'];?>"><?php echo $key['title'];?></option>
          <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Type</label>
          <select type="text" class="form-control" name="type">
            <option <?php echo ($flow['type']=="input")?"selected":"";?> value="input">input</option>
            <option <?php echo ($flow['type']=="notif")?"selected":"";?> value="notif">notif</option>
            <option <?php echo ($flow['type']=="output")?"selected":"";?> value="output">output</option>
          </select>
        </div>
        <div class="form-group">
          <label>Template</label>
          <textarea class="form-control" required name="template" id="template"><?php echo $flow['template'];?></textarea>
        </div>
        <div class="form-group">
          <label>Max Time</label>
          <input class="form-control" value="<?php echo $flow['max_time'];?>" required name="max_time" id="max_time" value="3">
        </div>
        <div class="form-group">
          <label>Max Pending</label>
          <input class="form-control" value="<?php echo $flow['max_time'];?>" required name="max_pending" id="max_pending" value="3">
        </div>
      	<div class="form-group">
      		<label>Need Check</label>
          <select type="text" class="form-control" name="need_check">
            <option <?php echo ($flow['need_check']=="1")?"selected":"";?> value="1">Yes</option>
            <option <?php echo ($flow['need_check']=="0")?"selected":"";?> value="0">No</option>
          </select>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" required name="description" id="description"><?php echo $flow['description'];?></textarea>
      	</div>
      	<div class="form-group">
      		<div class="pull-right">
      			<button type="submit" class="btn btn-primary">Submit</button>
      		</div>
      	</div>
      </form>
      </div>

      </div>

    </section>
  </div>

    <script type="text/javascript">
  setTimeout(function () {
  var id_user = "<?php echo $flow['assign_user'];?>";
  var split = id_user.split(",");
    for (data in split){
      $("#user_assign_id").jqxTree('checkItem', $("#"+split[data])[0], true);
    }
  },2000);
  </script>
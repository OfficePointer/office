  <div class="content-wrapper">

    <section class="content-header">
      <h1>
      Add Flowsys
      </h1>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-4">
      <label>User Assign</label>
      <div id="user_assign_id"></div>
      </div>
      <div class="col-md-8">
      <form method="POST" action="<?php echo base_url("servicedesk/flowsys_save");?>">
          <input class="form-control" type="hidden" required name="assign_user" id="id_user" value="">
        <div class="form-group">
          <label>Info</label>
          <select type="text" class="form-control" name="id_info">
          <?php foreach ($info as $key) { ?>
            <option value="<?php echo $key['id'];?>"><?php echo $key['title'];?></option>
          <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Type</label>
          <select type="text" class="form-control" name="type">
            <option value="input">input</option>
            <option value="notif">notif</option>
            <option value="output">output</option>
          </select>
        </div>
        <div class="form-group">
          <label>Template</label>
          <textarea class="form-control" required name="template" id="template"></textarea>
        </div>
        <div class="form-group">
          <label>Max Time</label>
          <input class="form-control" required name="max_time" id="max_time" value="3">
        </div>
        <div class="form-group">
          <label>Max Pending</label>
          <input class="form-control" required name="max_pending" id="max_pending" value="3">
        </div>
      	<div class="form-group">
      		<label>Need Check</label>
          <select type="text" class="form-control" name="need_check">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" required name="description" id="description"></textarea>
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
  get_user_assign();
  </script>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Send E-Mail DTR
      </h1>
    </section>
    <section class="content">
      <div class="row">

      <div class="col-md-4">
      <label>Recipients</label>
      <div id="user_assign_id"></div>
      </div>
      <div class="col-md-8">
      <form method="POST" action="<?php echo base_url("root/send_dtr_recipient");?>">
        <input class="form-control" type="hidden" required name="assign_user" id="id_user" value="">
        <div class="form-group">
          <label>Other E-Mail (Separate with comma)</label>
          <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
      		<div class="">
      			<button type="submit" class="btn btn-primary">Send</button>
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